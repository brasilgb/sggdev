<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Consumo;
use App\Models\Despesa;
use App\Models\Email;
use App\Models\Empresa;
use App\Models\Envio;
use App\Models\Estoque_ave;
use App\Models\Estoque_ovo;
use App\Models\Financeiro;
use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Periodo;
use PDF;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    /**
     * Relatório movimento diário
     */
    public function movimentodiario()
    {
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $empresa = Empresa::first();
        $lotes = Lote::where('periodo', Periodo::ativo())->get();
        $coletas = Coleta::get();
        $mortalidades = Mortalidade::get();
        $estoqueaves = Estoque_ave::get();
        $envioovos = Envio::get();
        $estoqueovos = Estoque_ovo::get();
        $aviarios = Aviario::get();
        $envios = Envio::get();


        return view('relatorios.movimento.movimentodiario', compact('lotes', 'aviarios', 'coletas', 'datarelatorio', 'mortalidades', 'estoqueaves', 'envioovos', 'estoqueovos', 'envios', 'empresa'));
    }

    public function pdfmovimentodiario(Request $request)
    {
        $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
        return response()->file($this->pdfmovimento($datarelatorio));
    }
    public function pdfmovimento($datarelatorio)
    {
        $data = [
            'datarelatorio' => $datarelatorio,
            'empresa' => Empresa::first(),
            'lotes' => Lote::where('periodo', Periodo::ativo())->get(),
            'coletas' => Coleta::get(),
            'mortalidades' => Mortalidade::get(),
            'estoqueaves' => Estoque_ave::get(),
            'envioovos' => Envio::get(),
            'estoqueovos' => Estoque_ovo::get(),
            'aviarios' => Aviario::get(),
            'envios' => Envio::get()
        ];

        $relatoriodir = 'Relatorios';
        if (!is_dir(public_path(DIRECTORY_SEPARATOR . $relatoriodir))) {
            mkdir(public_path(DIRECTORY_SEPARATOR . $relatoriodir));
        }
        $relatoriodir = 'Relatorios';
        $nomerelatorio = date("d_m_Y", strtotime($datarelatorio));
        $pdf_name = "relatorio-coletas-diario-$nomerelatorio.pdf";
        $path = public_path(DIRECTORY_SEPARATOR . $relatoriodir . DIRECTORY_SEPARATOR . $pdf_name);
        $pdf = PDF::loadView('relatorios.movimento.pdfmovimento', $data)->setPaper('a4', 'landscape')->save($path);

        return $path;
        //return $pdf->download('relatorio-coletas.pdf');
    }

    public function enviarelatorio(Request $request)
    {
        $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
        $attachment = $this->pdfmovimento($datarelatorio);
        $emaildata = Email::orderBy('id_email')->first();

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host = $emaildata->smtp;             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = $emaildata->usuario;   //  sender username
            $mail->Password = $emaildata->senha;       // sender password
            $mail->SMTPSecure = $emaildata->seguranca;                  // encryption - ssl/tls
            $mail->Port = $emaildata->porta;                          // port - 587/465

            $mail->setFrom($emaildata->usuario, $emaildata->remetente);
            $destinatarios = explode(',', $emaildata->destinatario);
            foreach ($destinatarios as $destino) :
                $mail->AddAddress(ltrim($destino), "");
            endforeach;

            // $mail->addCC($request->emailCc);
            // $mail->addBCC($request->emailBcc);

            $mail->addReplyTo($emaildata->usuario, $emaildata->remetente);

            if (isset($attachment)) {
                $mail->addAttachment($attachment);
            }

            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $emaildata->assunto;
            $mail->Body    = ($emaildata->mensagem);

            // $mail->AltBody = plain text version of email body;

            if (!$mail->send()) {
                return back()->with("failed", "Relatório do movimento diário não enviado.")->withErrors($mail->ErrorInfo);
            } else {
                return back()->with("success", "Relatório do movimento diário enviado com sucesso.");
            }
        } catch (Exception $e) {
            return back()->with('error', 'O relatório não foi enviado corretamente Verifique as configurações do servidor de e-mail e tente novamente!');
        }
    }
    /**
     * Fim relatório movimento diário
     */

    /**
     * Relatório de Coletas
     */

    public function coleta()
    {
        $segmento = Empresa::first();
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $lotes = Lote::where('periodo', Periodo::ativo())->get();
        $aviarios = Aviario::get();
        $coletas = Coleta::where('data_coleta', $datarelatorio)->get();

        return view('relatorios.coleta.coleta', compact('datarelatorio','lotes', 'aviarios', 'coletas', 'segmento'));
    }

    public function pdfcoleta(Request $request)
    {
        $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
        $data = [
            'datarelatorio' => $datarelatorio,
            'lotes' => Lote::where('periodo', Periodo::ativo())->get(),
            'coletas' => Coleta::where('data_coleta', $datarelatorio)->get(),
            'aviarios' => Aviario::get(),
            'segmento' => Empresa::first()
        ];

        $pdf = PDF::loadView('relatorios.coleta.pdfcoleta', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('relatorio-coletas.pdf');
    }
/**
 * Fim relatório de Coletas
 */

 /**
  * Relatório financeiro
  */
  public function financeiro()
  {
      $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
      $mesrelatorio = date("m", strtotime(now()));
      $coletas = Coleta::get();
      $despesas = DB::table('despesas')
      ->whereMonth('created_at', $mesrelatorio)
      ->get();
      $receitas = Financeiro::first();
      return view('relatorios.financeiro.financeiro', compact('datarelatorio', 'coletas', 'despesas', 'receitas'));
  }


  public function pdffinanceiro(Request $request)
  {
      $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
      $mesrelatorio = date("m", strtotime($datarelatorio));
      $despesas = DB::table('despesas')
      ->whereMonth('created_at', $mesrelatorio)
      ->get();
      $data = [
          'datarelatorio' => $datarelatorio,
          'coletas' => Coleta::get(),
          'receitas' => Financeiro::first(),
          'despesas' => $despesas
      ];

      $pdf = PDF::loadView('relatorios.financeiro.pdffinanceiro', $data)->setPaper('a4', 'landscape');
      return $pdf->stream('relatorio-financeiro.pdf');
  }
  /**
 * Fim relatório financeiro
 */

 /**
  * Relatório estoque de ave
  */
  public function estoqueave()
  {
      $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
      $aviarios = Aviario::get();
      $mortalidades = Mortalidade::where('data_mortalidade', $datarelatorio)->get();
      return view('relatorios.estoqueave.estoqueave', compact('datarelatorio', 'aviarios', 'mortalidades'));
  }


  public function pdfestoqueave(Request $request)
  {
      $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
      $data = [
          'datarelatorio' => $datarelatorio,
          'aviarios' => Aviario::get(),
          'mortalidades' => Mortalidade::where('data_mortalidade', $datarelatorio)->get()
      ];

      $pdf = PDF::loadView('relatorios.estoqueave.pdfestoqueave', $data)->setPaper('a4', 'landscape');
      return $pdf->stream('relatorio-estoque-aves.pdf');
  }
/**
 * Fim relatório estoque ave
 */

 /**
  * Relatório estoque de ovo
  */
  public function estoqueovo()
  {
      $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
      $coletas = Coleta::get();
      $envios = Envio::where('data_envio', $datarelatorio)->get();
      return view('relatorios.estoqueovo.estoqueovo', compact('datarelatorio', 'coletas', 'envios'));
  }


  public function pdfestoqueovo(Request $request)
  {
      $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
      $data = [
          'datarelatorio' => $datarelatorio,
          'coletas' => Coleta::get(),
          'envios' => Envio::where('data_envio', $datarelatorio)->get()
      ];

      $pdf = PDF::loadView('relatorios.estoqueovo.pdfestoqueovo', $data)->setPaper('a4', 'landscape');
      return $pdf->stream('relatorio-estoque-ovos.pdf');
  }

 /**
  * Relatório consumo de ração
  */
  public function consumo()
  {
      $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
      $lotes = Lote::get();
      $aviarios = Aviario::get();
      $consumos = Consumo::where('data_consumo', $datarelatorio)->get();

      return view('relatorios.consumo.consumo', compact('datarelatorio', 'lotes', 'aviarios', 'consumos'));
  }


  public function pdfconsumo(Request $request)
  {
      $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
      $data = [
          'datarelatorio' => $datarelatorio,
          'lotes' => Lote::get(),
          'aviarios' => Aviario::get(),
          'consumos' => Consumo::where('data_consumo', $datarelatorio)->get()
      ];

      $pdf = PDF::loadView('relatorios.consumo.pdfconsumo', $data)->setPaper('a4', 'landscape');
      return $pdf->stream('relatorio-consumo-racao.pdf');
  }


}
