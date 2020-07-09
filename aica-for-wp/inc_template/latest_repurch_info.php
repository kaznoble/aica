<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Latest Repurchase Offer</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<td>Status</td>';
$html .= '<td>' . $get_fund_info[0]['current_offering'] . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td>Start Date</td>';
$html .= '<td>' . date('M. d, Y', strtotime($get_fund_info[0]['repurchase_start'])) . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td>End Date</td>';
$html .= '<td>' . date('M. d, Y', strtotime($get_fund_info[0]['repurchase_end'])) . '</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td>Shares (%) to Repurchase</td>';
$html .= '<td>' . $get_fund_info[0]['to_repurchase'] . '</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>