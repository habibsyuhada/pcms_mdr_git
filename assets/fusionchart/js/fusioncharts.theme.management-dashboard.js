/*
 FusionCharts JavaScript Library
 Copyright FusionCharts Technologies LLP
 License Information at <http://www.fusioncharts.com/license>
*/

/**
 * This file create a theme file for the dashboard. The cosmetics for the
 * different charts are defined here.
 *
 * More information on theming can be found at
 * http://docs.fusioncharts.com/tutorial-configuring-your-chart-theme-manager.html
 */
FusionCharts.register('theme', {
    name: 'management',
    theme: {
        base: {
            chart: {
                baseFont: "'HelveticaNeue', 'Helvetica Neue', Helvetica, Arial, Verdana",
                baseFontSize: "11",
                baseFontColor: "#666666",
                bgAlpha: "0",
                bgColor: "#FFFFFF",
                canvasBorderThickness: "0",
                showBorder: "0",
                showShadow: "0"
            }
        },
        MSCombiDY2D: {
            chart: {
                caption: "",
                divLineDashed: "1",
                divLineDashLen: "2",
                formatNumberScale: 1,
                legendBorderThickness: 0,
                legendShadow: 0,
                paletteColors: "#88c057, #008487, #005072, #feb000, #5b8ab0, #29bac7, #e36966, #d4d6bc",
                plotHoverEffect: "1",
                plotSpacePercent: "50",
                pYAxisNameFontColor: "#333333",
                pYAxisNameFontSize: "11",
                showAlternateHGridColor: "0",
                showHoverEffect: "1",
                showPlotBorder: "0",
                showToolTipShadow: "0",
                showValues: "0",
                showXAxisLine: "1",
                sYAxisNameFontColor: "#333333",
                sYAxisNameFontSize: "11",
                toolTipBgColor: "#333333",
                toolTipBorderRadius: "2",
                toolTipColor: "#EEEEEE",
                toolTipFontSize: "11",
                useEllipsesWhenOverflow: 1,
                usePlotGradientColor: "0",
                xAxisNameFontColor: "#333333",
                xAxisNameFontSize: "11",
                xAxisLineColor: "#979797",
                xAxisLineThickness: "1",
                lineThickness: "3",
                anchorRadius: "4",
                anchorBorderThickness: "2"
            }
        },
        bar2d: {
            chart: {
                caption: "",
                divLineColor: "#999999",
                showAlternateVGridColor: "0",
                showPlotBorder: "0",
                showValues: 0,
                paletteColors: "#88c057",
                plotHoverEffect: "1",
                toolTipBgColor: "#333333",
                toolTipBorderRadius: "2",
                toolTipColor: "#EEEEEE",
                toolTipFontSize: "11",
                usePlotGradientColor: "0",
                yAxisNameFontColor: "#333333",
                yAxisNameFontSize: "11",
                yAxisLineColor: "#D4D4D4",
                yAxisLineThickness: "1",
                xAxisNameFontColor: "#333333",
                xAxisNameFontSize: "11",
                xAxisLineColor: "#D4D4D4"
            }
        },
        column2D: {
            chart: {
                caption: "",
                divLineDashed: "1",
                divLineDashLen: "2",
                paletteColors: "#88c057",
                showAlternateHGridColor: "0",
                showPlotBorder: "0",
                showXAxisLine: "1",
                showValues: 0,
                usePlotGradientColor: "0",
                xAxisNameFontColor: "#333333",
                xAxisNameFontSize: "11",
                xAxisLineColor: "#979797",
                xAxisLineThickness: "1",
                yAxisNameFontColor: "#333333",
                yAxisNameFontSize: "11",
                yAxisLineColor: "#979797"
            }
        },
        line: {
            chart: {
                anchorHoverRadius: "5",
                showHoverEffect: "1"
            }
        },
        stackedcolumn2d: {
            chart: {
                caption: "",
                divLineDashed: "1",
                divLineDashLen: "2",
                legendBorderThickness: 0,
                legendShadow: 0,
                paletteColors: "#88c057, #008487, #005072",
                showAlternateHGridColor: "0",
                showPlotBorder: "0",
                showXAxisLine: "1",
                showValues: 0,
                usePlotGradientColor: "0",
                xAxisNameFontColor: "#333333",
                xAxisNameFontSize: "11",
                xAxisLineColor: "#979797",
                xAxisLineThickness: "1",
                yAxisNameFontColor: "#333333",
                yAxisNameFontSize: "11",
                yAxisLineColor: "#979797"
            }
        },
        pie2d: {
            chart: {
                paletteColors: "#88c057, #008487, #005072, #feb000, #5b8ab0",
                plotHoverEffect: "1",
                showBorder: "0",
                showPercentValues: "1",
                showPlotBorder: "0",
                showShadow: "0",
                toolTipBgColor: "#333333",
                toolTipBorderRadius: "2",
                toolTipColor: "#EEEEEE",
                toolTipFontSize: "11",
                use3DLighting: "0"
            }
        },
        geo: {
            chart: {
                use3DLighting: "0",
                entityFillHoverColor: "#DDDDDD",
                entityFillHoverAlpha: "100",
                showshadow: "0",
                showEntityHoverEffect: "1",
                showLabels: "0",
                showmarkerlabels: "0",
                showBorder: "0",
                useSNameInLabels: "0",
                fillColor: "F9F9F9",
                legendPosition: "BOTTOM",
                legendBorderAlpha: "0",
                legendShadow: "0",
                legendItemFontSize: "10",
                legendItemFontColor: "#666666",
                toolTipBgColor: "#333333",
                toolTipBorderRadius: "2",
                toolTipColor: "#EEEEEE",
                toolTipFontSize: "11"
            }
        }
    }
});
