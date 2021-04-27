<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Email;
use App\Models\Empresa;
use App\Models\Envio;
use App\Models\Estoque_ave;
use App\Models\Estoque_ovo;
use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Periodo;
use PDF;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{

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

        return view('relatorios.movimentodiario', compact('lotes', 'aviarios', 'coletas', 'datarelatorio', 'mortalidades', 'estoqueaves', 'envioovos', 'estoqueovos', 'envios', 'empresa'));
    }

    public function pdfmovimentodiario(Request $request)
    {
        $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
        return response()->file($this->pdfcoletas($datarelatorio));
    }
    public function pdfcoletas($datarelatorio)
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
        $pdf = PDF::loadView('relatorios.pdfcoletas', $data)->setPaper('a4', 'landscape')->save($path);

        return $path;
        //return $pdf->download('relatorio-coletas.pdf');
    }

    public function enviarelatorio(Request $request)
    {
        $datarelatorio = Carbon::createFromFormat('d/m/Y', $request->datarelatorio)->format('Y-m-d');
        $attachment = $this->pdfcoletas($datarelatorio);
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
                return back()->with("failed", "Relatório não enviado não enviado.")->withErrors($mail->ErrorInfo);
            } else {
                return back()->with("success", "Relatório enviado com sucesso.");
            }
        } catch (Exception $e) {
            return back()->with('error', 'O relatório não foi enviado corretamente Verifique as configurações do servidor de e-mail e tente novamente!');
        }
    }
}
