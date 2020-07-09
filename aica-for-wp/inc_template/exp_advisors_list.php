<?php
	$html .= '<table class="table table-striped" ><thead><tr>';
	$html .= '<th>First Name</th>';
	$html .= '<th>Last Name</th>';	
	$html .= '<th>Title</th>';
	$html .= '<th>Firm</th>';
	$html .= '<th>Year enter the business</th>';
	$html .= '<th>Year Focused on CEFs/BDCs</th>';	
	$html .= '<th>Custodians</th>';
	$html .= '<th>% Practice Focused on CEFs/BDCs</th>';
	$html .= '<th>$ AUM MM</th>';
	$html .= '<th>Profile updated date</th>';	
	$html .= '</tr></thead><tbody>';
	foreach($result As $res)
	{
		$html .= '<tr>';
		$html .= '<td class="exp_profile_column" ><a href="#" class="a_ad_prof" data-toggle="modal" data-target=".fusion-modal.advisorprofile" data-id="' . $res->exp_ad_ID . '" >' . $res->exp_firstname . '</a></td>';
		$html .= '<td>' . $res->exp_lastname . '</td>';		
		$html .= '<td>' . $res->exp_title . '</td>';	
		$html .= '<td>' . $res->exp_firm . '</td>';
		$html .= '<td>' . $res->exp_year_entered . '</td>';
		$html .= '<td>' . $res->exp_year_started . '</td>';		
		$html .= '<td>' . $res->exp_custodians . '</td>';
		$html .= '<td>' . $res->exp_perc_prac . '</td>';
		$html .= '<td>' . $res->exp_ad_aum . '</td>';
		$html .= '<td>' . date('m/d/Y', strtotime($res->exp_date_updated)) . '</td>';		
		$html .= '</tr>';		
	}
	$html .= '</tbody></table>';
?>