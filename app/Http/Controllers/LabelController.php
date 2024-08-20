<?php

namespace App\Http\Controllers;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\Fpdf;

use Illuminate\Http\Request;
use App\Repositories\MELI\MELIShipmentsRepository;

class LabelController extends Controller
{
    protected $meliShipmentsRepository;

    public function __construct(
        MELIShipmentsRepository $meliShipmentsRepository
    ) {
        $this->meliShipmentsRepository = $meliShipmentsRepository;
    }

    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function print(Request $request)
    {
        $order = json_decode($request->input('order'), true);
        $shipping_id = $order['shipping']['id'];
        $items = $order['order_items'];

        $labelResponse = $this->meliShipmentsRepository->getShippingLabels($shipping_id);

        if (is_string($labelResponse) && $this->isJson($labelResponse)) {
            $labelData = json_decode($labelResponse, true);
            if (isset($labelData['message'])) {
                return redirect()->back()->withErrors(['error' => $labelData['message']]);
            }
        }

        $tempFilePath = storage_path('app/temp_label.pdf');
        file_put_contents($tempFilePath, $labelResponse);

        if (!file_exists($tempFilePath) || !is_readable($tempFilePath)) {
            return response()->json(['error' => 'No se pudo generar el archivo PDF de la etiqueta.'], 500);
        }

        $pdf = new Fpdi();

        $pageCount = $pdf->setSourceFile($tempFilePath);

        if ($pageCount === 0) {
            return response()->json(['error' => 'El archivo PDF no tiene páginas o no se pudo procesar.'], 500);
        }

        $text = '';

        foreach ($items as $item) {
            $sku = $item['item']['seller_sku'];
            $sku2 = $item['item']['seller_custom_field'];
            $quantity = $item['quantity'];

            $text .= "$sku\t$sku2\t$quantity unidades\n";
        }

        $text = utf8_decode($text);

        $pdf->AddPage();
        $tplIdx = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx);

        $pdf->SetFont('Arial', 'B', 11);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(15, 70);
        $pdf->MultiCell(0, 5, $text);

        // Guardar el PDF modificado
        $modifiedFilePath = storage_path('app/' . $order['id'] . '.pdf');
        $pdf->Output('F', $modifiedFilePath);

        // Retornar el archivo modificado como descarga
        return response()->download($modifiedFilePath)->deleteFileAfterSend(true);
    }
}
