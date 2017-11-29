<?php error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
    <title>CHLOROComm Admin | Dashboard</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=" short icon" href="<?php echo base_url();?>img/chlorodots_logo.ico">
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
    <!-- DATA TABLES -->
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Chosen -->
    <link href="<?php echo base_url();?>assets/js/chosen/docsupport/prism.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/js/chosen/chosen.css" rel="stylesheet">
    <!--Datepicker -->
    <link href="<?php echo base_url();?>assets/css/datepicker/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/css/timepicki.min.css" rel="stylesheet">
    <!-- Calculator -->
    <link href="<?php echo base_url();?>assets/css/plugins/calculator/CalcSS3.css" rel="stylesheet">
    <!-- Calender -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.6.2/fullcalendar.min.css">
    <!-- editor -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/js/jwysiwyg-master/jquery.wysiwyg.css" type="text/css"/>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jwysiwyg-master/help/lib/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jwysiwyg-master/jquery.wysiwyg.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jwysiwyg-master/controls/wysiwyg.image.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jwysiwyg-master/controls/wysiwyg.link.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jwysiwyg-master/controls/wysiwyg.table.js"></script>
    <script type="text/javascript">
        (function($) {
            $(document).ready(function() {
                $('#wysiwyg,#wysiwyg2,#wysiwyg3').wysiwyg({
                  controls: {
                    bold          : { visible : true },
                    italic        : { visible : true },
                    underline     : { visible : true },
                    strikeThrough : { visible : true },

                    justifyLeft   : { visible : true },
                    justifyCenter : { visible : true },
                    justifyRight  : { visible : true },
                    justifyFull   : { visible : true },

                    indent  : { visible : true },
                    outdent : { visible : true },

                    subscript   : { visible : true },
                    superscript : { visible : true },

                    undo : { visible : true },
                    redo : { visible : true },

                    insertOrderedList    : { visible : true },
                    insertUnorderedList  : { visible : true },
                    insertHorizontalRule : { visible : true },

                    h4: {
                        visible: true,
                        className: 'h4',
                        command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
                        arguments: ($.browser.msie || $.browser.safari) ? '<h4>' : 'h4',
                        tags: ['h4'],
                        tooltip: 'Header 4'
                    },
                    h5: {
                        visible: true,
                        className: 'h5',
                        command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
                        arguments: ($.browser.msie || $.browser.safari) ? '<h5>' : 'h5',
                        tags: ['h5'],
                        tooltip: 'Header 5'
                    },
                    h6: {
                        visible: true,
                        className: 'h6',
                        command: ($.browser.msie || $.browser.safari) ? 'formatBlock' : 'heading',
                        arguments: ($.browser.msie || $.browser.safari) ? '<h6>' : 'h6',
                        tags: ['h6'],
                        tooltip: 'Header 6'
                    },

                    cut   : { visible : true },
                    copy  : { visible : true },
                    paste : { visible : true },
                    html  : { visible: true },
                    increaseFontSize : { visible : true },
                    decreaseFontSize : { visible : true },
                    exam_html: {
                        exec: function() {
                            this.insertHtml('<abbr title="exam">Jam</abbr>');
                            return true;
                        },
                        visible: true
                    }
                },
                events: {
                    click: function(event) {
                        if ($("#click-inform:checked").length > 0) {
                            event.preventDefault();
                            alert("You have clicked jWysiwyg content!");
                        }
                    }
                }
            });

        //$('#wysiwyg').wysiwyg("insertHtml", "Sample code");
    });
        })(jQuery);
    </script>
    <!-- <script>
        function date_time(id){
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December');
            d = date.getDate();
            day = date.getDay();
            days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            h = date.getHours();
            if(h<10){
                h = "0"+h;
            }
            m = date.getMinutes();
            if(m<10){
                m = "0"+m;
            }
            s = date.getSeconds();
            if(s<10){
                s = "0"+s;
            }
            result = '<br></br><div class="text-center" style="font-size:large;"><i class="fa fa-calendar"></i> '+days[day]+' '+months[month]+' '+d+' '+year+'<br/><br/><div class="text-center" style="font-size:80px;"><i class="fa fa-clock-o"></i> '+h+':'+m+':'+s+'</div><br>';
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("'+id+'");','1000');
            return true;
        }
    </script> -->
</head>
<body>