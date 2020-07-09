<?php
$html = '<div class="div_non_summary_table" >';
$html .= '<table class="table table-striped">';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th colspan="2" >Capital Structure</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';
$html .= '<tr>';
$html .= '<td>Managed Assets (' . date('M. d, Y', strtotime($get_fund_info[0]['managed_assets_date'])) . ')</td>';
$html .= '<td>$' . $get_fund_info[0]['managed_assets_m'] . 'M</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td>Net Assets (' . date('M. d, Y', strtotime($get_fund_info[0]['net_assets_interim_date'])) . ')</td>';
$html .= '<td>$' . $get_fund_info[0]['net_assets_interim_m'] . 'M</td>';
$html .= '</tr>';
$html .= '<tr>';
$html .= '<td>Leverage <i>as % of Managed Assets</i> (' . date('M. d, Y', strtotime($get_fund_info[0]['leverage_aum_date'])) . ')</td>';
$html .= '<td>' . $get_fund_info[0]['leverage_aum'] . '%</td>';
$html .= '</tr>';
$html .= '</tbody>';
$html .= '</table>';
$html .= '</div>';
?>