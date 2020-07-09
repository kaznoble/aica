<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Tender Results</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<td>Last Tendered (%) <i>on ' . date('M. d, Y', strtotime($get_fund_info[0]['last_tender_date'])) . '</i></td>';
$html .= '<td>' . $get_fund_info[0]['last_tender'] . '</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>