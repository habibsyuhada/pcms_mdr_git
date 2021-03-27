<?php
 
class Pdfgenerator_weekly_notif
{
  public function define_contant()
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);
  }
  
  public function generate($html,$filename)
  {
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    // $dompdf->set_option("isPhpEnabled", true);
    $dompdf->set_paper('A4','potrait');
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
    $font_no_bold = Font_Metrics::get_font("helvetica");

    // $h = $pdf->get_height();
    // $y = $h - 24;

    //$canvas->page_text(50, 820, $app_nos, $font, 6, array(0,0,0));
    // $canvas->page_text(285, 820, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));
    $canvas->page_text(370, 820, "This Data Is Collected From PCMS Database ({PAGE_NUM} of {PAGE_COUNT})", $font, 7, array(0,0,0));

    //$canvas->page_text(420, 820, "Printed On: ".date('d-M-Y H:i:s A'), $font_no_bold, 6, array(0,0,0));
    // $canvas->page_text(510, 20, $html, $font, 6, array(0,0,0));
    // ob_end_clean();
    // $dompdf->stream($filename.'.pdf',array("Attachment"=>0));

    $pdf = $dompdf->output();
    $file_location = 'file/weekly_notif/'.$filename;
    file_put_contents($file_location,$pdf); 
  }
}
?>