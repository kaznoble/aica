<?php
$x = 1;
$html .= '<nav aria-label="Page navigation example">
	  <ul class="pagination" num-pages="noOfPages" current-page="currentPage" >
		<li ng-class="prevLink" class="page-item"><a class="page-link" ng-click="selectPage(' . ($x - 1) . ',' . $limit_no . ',pageLink' . ($x - 1) . ')" >Previous</a></li>';
		for($x = 1; $x <= $page_split; $x++)
		{
			$html .= '<li class="page-item pageLink' . $x . '" ng-class="pageLink" ><a class="page-link" ng-click="selectPage(' . $x . ',' . $limit_no . ',pageLink' . $x . ')" >' . $x . '</a></li>';
		}
$html .= '<li ng-class="nextLink" class="page-item"><a class="page-link" ng-click="selectPage(' . ($x + 1) . ',' . $limit_no . ',pageLink' . ($x + 1) . ')" >Next</a></li>
	  </ul>
	</nav>';

?>