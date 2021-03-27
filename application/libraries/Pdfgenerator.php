<?php
 
class Pdfgenerator
{
  public function generate($html,$filename,$app_nos)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    // $dompdf->set_option("isPhpEnabled", true);
    $dompdf->set_paper('A4','landscape');
    $dompdf->load_html($html);
    $dompdf->render();


    // // Parameters
    // $x          = 505;
    // $y          = 790;
    // $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
    // // $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
    // $font       = Font_Metrics::get_font('helvetica', 'normal');
    // $size       = 10;    
    // $color      = array(0,0,0);
    // $word_space = 0.0;
    // $char_space = 0.0;
    // $angle      = 0.0;
    // $dompdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);

    // $dompdf->getCanvas()->page_text(
    //   $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
    // );

    // $w = $pdf->get_width();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");

    // $h = $pdf->get_height();
    // $y = $h - 24;

    
    $canvas->page_text(400, 570, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    $canvas->page_text(30, 570, $app_nos, $font, 6, array(0,0,0));
    // $canvas->page_text(510, 20, $html, $font, 6, array(0,0,0));

    ob_end_clean();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}
?>