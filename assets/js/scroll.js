$(document).ready(function(){
    $(document).scroll(function(){
        var scz = $(document).scrollTop();
        var disp = $("header").css("display");
        if (scz <= 5)
        {
            if (disp === "none")
            {
                $("header").slideDown("fast");
            }
        }
        else
        {
            if (disp === "block")
            {
                $("header").slideUp("fast");
            }
        }
    });
    var a = [];
    var ind = 0;

    var hide = function(start,stop)
            {
                for(var i=start;i<stop;i++)
                {
                    $("ul:first").children().eq(i).css("display","none");
                }
            }

    var show = function(start,stop)
            {
                for(var i=start;i<stop;i++)
                {
                    $("ul:first").children().eq(i).css("display","inline-table");
                }
            }

    var set_menu = function()
                {
                    var a=[];
                    var last = 0;
                    a.push(0);
                    var arrow_width = 2*$(".goright").width();
                    var full_width = arrow_width;
                    var max_width = $("nav").width();

                    $("ul:first").children().each(function(){
                        if (!$(this).hasClass("goleft") && !$(this).hasClass("goright"))
                        {
                            full_width = full_width + $(this).width();
                            last = $(this).index();
                            if (full_width > max_width)
                            {
                                a.push($(this).index());
                                full_width = $(this).width()+arrow_width;
                            }
                        }
                    });
                    a.push(last+1);
                    return a;
                }


    var slide_menu = function()
                        {
                            hide(a[0],a[a.length-1]);
                            show(a[ind],a[ind+1]);

                            if (ind > 0)
                            {
                                $(".goleft").css("display","inline-table");
                            }
                            else
                            {
                                $(".goleft").css("display","none");
                            }

                            if (a[ind+2])
                            {
                                $(".goright").css("display","inline-table");
                            }
                            else
                            {
                                $(".goright").css("display","none");
                            }
                        }


    $(".goright").click(function(){
        ind = ind+1;
        slide_menu();
    });

    $(".goleft").click(function(){
        ind = ind-1;
        slide_menu();
    });

    var id;

    $(window).resize(function(){
        //make sure to call only once
        clearTimeout(id);
        id = setTimeout(doneResizing,500);
    });

    function doneResizing(){
        a = set_menu();
        if (ind > a.length-2)
        {
            ind = a.length-2;
        }
        slide_menu();
    }


/*
var o1 = $("nav").offset();
var o1w = $("nav").width();
var o1h = $("nav").height();

//check wich element is overflow
$("ul:first").children().each(function(){
    var o2 = $(this).offset();
    var o2w = $(this).width();
    var o2h = $(this).height();

    if (o2.top + o2h > o1.top + o1h || o2.left + o2w > o1.left + o1w)
    {
        if ($this.css("display") !== "none")
        {
            $(this).css("display",none);
        }
        alert($(this).text());
    }
});
*/
});
