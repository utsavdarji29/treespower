$(document).ready(function() {    

    $('.close-sidemenu').click(function() {        

        $(".sidebar-main").toggleClass('sidemenu-effect');        

        $('.dashboard-right-side-main').toggleClass('d-right-effect');        

        $('.top-header-main').toggleClass('d-right-effect');    

        

    });    

    ('li.child-menu').click(function() {        

        $(this).find("ul.sub-menu").slideToggle();        

        $(this).find(".menu-arrow").toggleClass('before');    

        

    });    

    $('#menu-icon').click(function(){        

        $('.sidebar-main.mobile-view').addClass('open-menu');    

        

    });   

    $('.close-menu').click(function(){        

        $('.sidebar-main.mobile-view').removeClass('open-menu');    

        

    });    

    $('#basic-text1').click(function() {        

        if($('#search_form')) 

        {            

            $('#search_form').submit();        

            

        }   

        });

    

});



var csv_treeReport = function()

        {        

            $table = $('#tree_example');   

            var $rows = $table.find('tr:has(td),tr:has(th)'),

            

            tmpColDelim = String.fromCharCode(11), // vertical tab character

            tmpRowDelim = String.fromCharCode(0), // null character



            // actual delimiter characters for CSV format

            rowDelim = '"\r\n"',

            colDelim = '","',



            // Grab text from table into CSV formatted string

            csv = '"' + $rows.map(function (i, row) {

                var $row = jQuery(row), $cols = $row.find('td,th');



                return $cols.map(function (j, col) {

                    len = jQuery(col).find("h1").length;

                    

                    if(len > 0){

                        var $col = jQuery(col), text = $col.find('h1').text();

                    }else{

                        var $col = jQuery(col), text = $col.text();

                    }

                    text = text.trim();

                    return text.replace(/"/g, '""'); // escape double quotes



                }).get().join(tmpColDelim);



            }).get().join(tmpRowDelim)

                .split(tmpRowDelim).join(rowDelim)

                .split(tmpColDelim).join(colDelim) + '"',

            

                    

            csvData = encodeURIComponent(csv);

            var formElement = document.querySelector("form");

            var formdata = new FormData(formElement);



            var tdate = new Date();

            var dd = tdate.getDate();

            var MM = tdate.getMonth();

            var yyyy = tdate.getFullYear();

            var currentDate = dd + "-" + (MM + 1) + "-" + yyyy;

            filename = 'treeReport_'+currentDate+'.csv';

            formdata.append('filename', filename);

            formdata.append('file', csvData);

            $.ajaxSetup({

              headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $.ajax({

                    type: "POST",                   

                    url:'exportCSV',

                    data: formdata,

                    processData: false,

                    contentType: false,            

                    success: function(data)

                    {

                        window.open('http://treespower.com.sg/treespower/download_csv.php?file='+filename, '_blank');

                    },

                    error: function(data) {                

                        alert("something wrong!");                

                    }

                });

        }