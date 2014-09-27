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
    var last_ind = 0;

    var show_hide = function(tmp, val)
    {
        for(var i in tmp)
        {
            $("ul:first").children().eq(tmp[i]).css("display",val);
        }
    }

    var set_menu = function()
    {
        var a=[];
        var width;
        var tmp = [];
        var tmp_width = [];
        var full_width = 0;
        var arrow_width = $(".goright").width();
        var max_width = $("nav").width();

        $("ul:first").children().each(function(){
            if (!$(this).hasClass('goleft') && !$(this).hasClass('goright'))
            {
                tmp_width.push($(this).width());
                tmp.push($(this).index());
                full_width += $(this).width();
            }
        });

        if (full_width < max_width)
        {
            a.push(tmp);
        }
        else
        {
            var last_array = [];
            var width = arrow_width + tmp_width[0];
            do
            {
                tmp_width.shift();
                last_array.push(tmp.shift());
                width += tmp_width[0];
            } while (width < max_width && tmp.length > 0)
            a.push(last_array);

            last_array = [];
            width = arrow_width + tmp_width[tmp_width.length - 1];
            do
            {
                tmp_width.pop();
                last_array.push(tmp.pop());
                width += tmp_width[tmp_width.length-1];
            } while (width < max_width && tmp.length > 0)

            var in_array = [];
            while(tmp.length > 0)
            {
                width = 2*arrow_width + tmp_width[0];
                do
                {
                    tmp_width.shift();
                    in_array.push(tmp.shift());
                    width += tmp_width[0];
                } while (width < max_width && tmp.length > 0)
                a.push(in_array);
                in_array = [];
            }

            a.push(last_array);
        }

        return a;
    }

    var slide_menu = function()
    {
        show_hide(a[ind], 'inline-table');
        show_hide(a[last_ind], 'none');
        toggleLeftRight();
    }

    var toggleLeftRight = function()
    {
        if (ind > 0)
        {
            $(".goleft").css("display","inline-table");
        }
        else
        {
            $(".goleft").css("display","none");
        }

        if (a[ind+1])
        {
            $(".goright").css("display","inline-table");
        }
        else
        {
            $(".goright").css("display","none");
        }
    }

    var doneResizing = function()
    {
        a = set_menu();
        if (a.length - 1 < ind)
        {
            ind = a.length - 1
        }
        for (var i = 0; i < a.length; i++)
        {
            //console.log(a[i].toString());
            if (i != ind)
            {
                show_hide(a[i], 'none');
            }
            else
            {
                show_hide(a[i], 'inline-table');
            }
        }

        toggleLeftRight();
    }

    var id;
    $(window).resize(function()
    {
        //make sure to call only once
        clearTimeout(id);
        id = setTimeout(doneResizing,500);
    });
    $(".goright").click(function(){
        last_ind = ind;
        ind = ind+1;
        slide_menu();
    });

    $(".goleft").click(function(){
        last_ind = ind;
        ind = ind-1;
        slide_menu();
    });

});
