$(function() {   
    $.ajax({
        url: 'fusionchart/wh_1progress_data.php',
        // data: {c_cluster:clusters, c_plant:plant, c_lob:lob, c_fam:fam},
        // data: {c_plant:plant, c_lob:lob, c_fam:fam},
        // data: {c_plant:plant},
        type: 'POST',
        success: function(data) {
            chartData = data;
            var  chartProperties = {
                "numvisibleplot": "6",
                "decimals": "1",
                "stack100percent": "1",
                "valuefontcolor": "#FFFFFF",
                "plottooltext": "$label has $dataValue (<b>$percentValue</b>) $seriesName",
                "xAxisName": "Plant",
                "yAxisName": "Percentage",                
                "paletteColors": "#ff4945, #2AC940",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "showCanvasBorder": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placeValuesInside": "1",
                "valueFontColor": "#ffffff",
                "showAxisLines": "1",
                "axisLineAlpha": "25",
                "divLineAlpha": "10",
                "alignCaptionWithCanvas": "0",
                "showAlternateVGridColor": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "showPercentValues": "0",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5",
                "animation": "1",
                "exportenabled": "0",
                "exportatclient": "1"
            };
            chartCategories=data.categories;
            chartDataset=data.dataset;
            apiChart = new FusionCharts({
                type: 'stackedbar2d',
                // id: 'visitor_chart_bar2d',
                renderAt: 'chart-wh_1progress',
                /*width: '600',
                height: '600',*/
                width: '100%',
                height: '300',
                // width: '500',
                dataFormat: 'json',
                dataSource: {
                    "chart": chartProperties,
                    "categories": chartCategories,
                    "dataset":chartDataset
                }                
            });
            apiChart.render();
        }
    });
});