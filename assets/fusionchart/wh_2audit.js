$(function() {   
    $.ajax({
        url: 'fusionchart/wh_2audit_data.php',
        // data: {c_cluster:clusters, c_plant:plant, c_lob:lob, c_fam:fam},
        // data: {c_plant:plant, c_lob:lob, c_fam:fam},
        // data: {c_plant:plant},
        type: 'POST',
        success: function(data) {
            chartData = data;
            var  chartProperties = {
                "xAxisName": "Plant",
                "yAxisName": "Percentage",                
                "paletteColors": "#72757A, #3FB6E8",
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
                "toolTipBorderThickness": "0",
                "showPercentValues": "1",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5",
                "animation": "1",
                "showvalues": "1",
                "placevaluesinside": "1",
                "exportenabled": "0",
                "exportatclient": "1",
                "showPercentInTooltip": "1",
                "numberSuffix": "%",
                "theme": "fusion"
            };
            chartCategories=data.categories;
            chartDataset=data.dataset;
            apiChart = new FusionCharts({
                type: 'mscolumn2d',
                // id: 'visitor_chart_bar2d',
                renderAt: 'chart-wh_2audit',
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