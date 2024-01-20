<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8"/>
    <title>GreenCloud</title>

    <script type="text/javascript" src="./assets/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/scripts/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="./assets/scripts/jquery.history.js"></script>
    <script type="text/javascript" src="./assets/scripts/jquery.tooltip.min.js"></script>
    <script type="text/javascript" src="./assets/scripts/raphael-min.js"></script>
    <script type="text/javascript" src="./assets/scripts/Tween.js"></script>
    <script type="text/javascript" src="./assets/scripts/bubbletree.js"></script>
    <script type="text/javascript" src="./assets/scripts/aggregator.js"></script>
    <link rel="stylesheet" type="text/css" href="./assets/styles/bubbletree.css"/>
    <script type="text/javascript" src="./assets/styles/cofog.js"></script>

    <script type="text/javascript">
        $(function () {
            var $tooltip = $('<div class="tooltip">Tooltip</div>');
            $('.bubble-chart').append($tooltip);
            $tooltip.hide();

            var getTooltip = function () {
                return this.getAttribute('tooltip');
            };

            var initTooltip = function (node, domnode) {
                domnode.setAttribute('tooltip', node.label + ' &nbsp;<br /><big><b>' + node.famount + '</b></big>');

                vis4.log(domnode.getAttribute('tooltip'));

                $(domnode).tooltip({delay: 200, bodyHandler: getTooltip});
            };
            var data = {
                'anio':<?php echo $_GET['anio']?>,
                'id':<?php echo $_GET['id']?>,
                'tipo':<?php echo $_GET['tipo']?>,
                'idioma':<?php echo $_GET['idioma']?>
            };
            new OpenSpending.Aggregator({
                apiUrl: 'https://bcie.greencloud.xyz/api/public/api/bubletree',
                dataset: data,
                drilldowns: ['swg', 'sector_objective'],
                rootNodeLabel: 'Uganda Budget',
                breakdown: 'spending_source_type',
                callback: function (data) {
                    if (data.amount == 0) {
                        $("#no_data_grafica").show();
                    }
                    else {
                        new BubbleTree({
                            autoColors: true,
                            data: data,
                            container: '.bubbletree',
                            //tooltipCallback: tooltip,
                            bubbleType: 'donut',
                            initTooltip: initTooltip,
                            maxNodesPerLevel: 100,
                        });
                    }
                }
            });
        });
    </script>
</head>
<body>
<div class="bubbletree-wrapper">
    <div id="no_data_grafica" style="display: none; text-align: center;color: #808081">
        No se contiene suficiente informacion par graficar.
    </div>
    <div class="bubbletree"></div>
</div>
</body>
</html>
