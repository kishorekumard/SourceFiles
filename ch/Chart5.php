<?php include("database.php");?>
<!DOCTYPE html>
<html>
	<head>
		<link  id='GoogleFontsLink' href='http://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css'><link  id='GoogleFontsLink' href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'><link  id='GoogleFontsLink' href='http://fonts.googleapis.com/css?family=Varela Round' rel='stylesheet' type='text/css'><link  id='GoogleFontsLink' href='http://fonts.googleapis.com/css?family=Hind' rel='stylesheet' type='text/css'>
		<script>
 WebFontConfig = {
 google: 
{families: ["Open Sans","Abel","Varela Round","Hind",]},active: function() { 
 DrawTheChart(ChartData,ChartOptions,"chart-01","Pie")}
};
		</script>
		<script asyn src="webfont.js">
		</script><script src="Chart.min.js"></script> 
		<script>
function DrawTheChart(ChartData,ChartOptions,ChartId,ChartType){
eval('var myLine = new Chart(document.getElementById(ChartId).getContext("2d")).'+ChartType+'(ChartData,ChartOptions);document.getElementById(ChartId).getContext("2d").stroke();')
}
		</script>
	</head>
	<body>
		<canvas  id="chart-01" width="500" height="500"></canvas>
		<script> 
                    function MoreChartOptions(){} 
                    var ChartData = [
                        <?php  
                            $sql = "SELECT project,nh as count FROM samp";
                            $result = $conn->query($sql);
                            $cnt = $result->num_rows;
                            if ($result->num_rows > 0)
                            {
                                $i = 0;
                                while($row = $result->fetch_assoc())
                                {
                                    ++$i;   
                                    echo "{value :".$row["count"].",color:'rgba(".rand(0,255).",".rand(0,255).",".rand(0,255).",".rand(0,255).")',title:'".$row["project"]."'}";
                                    echo ($i<$cnt)?',':''; 
                             } } 
                        ?>
                 ];
                    ChartOptions= {canvasBackgroundColor:'rgba(255,255,255,1.00)',spaceLeft:12,spaceRight:12,spaceTop:12,spaceBottom:12,canvasBorders:false,canvasBordersWidth:1,canvasBordersStyle:"solid",canvasBordersColor:"rgba(0,0,0,1)",scaleLabel:"<%=value+''%>",yAxisMinimumInterval:'none',scaleShowLabels:true,scaleShowLine:true,scaleLineStyle:"solid",scaleLineWidth:1,scaleLineColor:"rgba(0,0,0,0.6)",scaleOverlay :false,scaleOverride :false,scaleSteps:10,scaleStepWidth:10,scaleStartValue:0,inGraphDataShow:true,inGraphDataTmpl:'<%=v1%>',inGraphDataFontFamily:"'Abel'",inGraphDataFontStyle:"normal bold",inGraphDataFontColor:"rgba(5,5,5,0.84)",inGraphDataFontSize:17,inGraphDataPaddingX:0,inGraphDataPaddingY:-5,inGraphDataAlign:"center",inGraphDataVAlign:"middle",inGraphDataXPosition:2,inGraphDataYPosition:3,inGraphDataAnglePosition:2,inGraphDataRadiusPosition:2,inGraphDataRotate:"inRadiusAxisRotateLabels",inGraphDataPaddingAngle:0,inGraphDataPaddingRadius:30, inGraphDataBorders:false,inGraphDataBordersXSpace:1,inGraphDataBordersYSpace:1,inGraphDataBordersWidth:1,inGraphDataBordersStyle:"solid",inGraphDataBordersColor:"rgba(0,0,0,1)",legend:false,maxLegendCols:5,legendBlockSize:15,legendFillColor:'rgba(255,255,255,0.00)',legendColorIndicatorStrokeWidth:1,legendPosX:-2,legendPosY:4,legendXPadding:0,legendYPadding:0,legendBorders:false,legendBordersWidth:1,legendBordersStyle:"solid",legendBordersColors:"rgba(102,102,102,1)",legendBordersSpaceBefore:5,legendBordersSpaceLeft:5,legendBordersSpaceRight:5,legendBordersSpaceAfter:5,legendSpaceBeforeText:5,legendSpaceLeftText:5,legendSpaceRightText:5,legendSpaceAfterText:5,legendSpaceBetweenBoxAndText:5,legendSpaceBetweenTextHorizontal:5,legendSpaceBetweenTextVertical:5,legendFontFamily:"'Hind'",legendFontStyle:"normal normal",legendFontColor:"rgba(0,0,0,1)",legendFontSize:12,showYAxisMin:false,rotateLabels:"smart",xAxisBottom:true,yAxisLeft:true,yAxisRight:false,graphTitleSpaceBefore:5,graphTitleSpaceAfter:5, graphTitleBorders:false,graphTitleBordersXSpace:1,graphTitleBordersYSpace:1,graphTitleBordersWidth:1,graphTitleBordersStyle:"solid",graphTitleBordersColor:"rgba(0,0,0,1)",graphTitle : "Chart Title",graphTitleFontFamily:"'Varela Round'",graphTitleFontStyle:"normal normal",graphTitleFontColor:"rgba(53,55,56,1)",graphTitleFontSize:24,footNoteSpaceBefore:5,footNoteSpaceAfter:5, footNoteBorders:false,footNoteBordersXSpace:1,footNoteBordersYSpace:1,footNoteBordersWidth:1,footNoteBordersStyle:"solid",footNoteBordersColor:"rgba(0,0,0,1)",footNote : "Add your Note Here",footNoteFontFamily:"'Open Sans'",footNoteFontStyle:"normal normal",footNoteFontColor:"rgba(102,102,102,1)",footNoteFontSize:12,scaleFontFamily:"'Open Sans'",scaleFontStyle:"normal normal",scaleFontColor:"rgba(0,0,0,1)",scaleFontSize:12,pointLabelFontFamily:"'Open Sans'",pointLabelFontStyle:"normal normal",pointLabelFontColor:"rgba(102,102,102,1)",pointLabelFontSize:12,angleShowLineOut:true,angleLineStyle:"solid",angleLineWidth:1,angleLineColor:"rgba(0,0,0,0.1)",percentageInnerCutout:50,scaleShowGridLines:true,scaleGridLineStyle:"solid",scaleGridLineWidth:1,scaleGridLineColor:"rgba(0,0,0,0.1)",scaleXGridLinesStep:1,scaleYGridLinesStep:3,segmentShowStroke:false,segmentStrokeStyle:"solid",segmentStrokeWidth:0,segmentStrokeColor:"rgba(255,255,255,1.00)",datasetStroke:true,datasetFill : true,datasetStrokeStyle:"solid",datasetStrokeWidth:2,bezierCurve:true,bezierCurveTension :0.4,pointDotStrokeStyle:"solid",pointDotStrokeWidth : 1,pointDotRadius : 3,pointDot : true,scaleTickSizeBottom:5,scaleTickSizeTop:5,scaleTickSizeLeft:5,scaleTickSizeRight:5,barShowStroke : false,barBorderRadius:0,barStrokeStyle:"solid",barStrokeWidth:1,barValueSpacing:15,barDatasetSpacing:0,scaleShowLabelBackdrop :true,scaleBackdropColor:'rgba(255,255,255,0.75)',scaleBackdropPaddingX :2,scaleBackdropPaddingY :2,animation : true,onAnimationComplete : function(){MoreChartOptions()}};
 DrawTheChart(ChartData,ChartOptions,"chart-01","Pie");</script></body></html>