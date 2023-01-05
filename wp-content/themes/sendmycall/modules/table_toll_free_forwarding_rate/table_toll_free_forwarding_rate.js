(function($){
    $(document).ready(function() {
        function getDropDownList(name, id) {
            let combo = $("<select></select>").attr("id", id).attr("name", name);
            let optionList = [];

            $( "#countries tr" ).each(function() {
                let item = $( this ).attr("class");
                let idx = $.inArray(item , optionList);
                if (idx == -1 && item !== undefined) {
                    optionList.push(item);
                }
            });

            combo.append("<option>Select country for filter</option>");

            $.each(optionList, function (i, el) {
                combo.append("<option>" + el + "</option>");
            });
        }

        getDropDownList("select_country", "sel_country");

        $( "#sel_country" )
            .change(function () {
                let sel_class = this.value;
                $( "#countries tr" ).each(function() {
                    let item = $( this ).attr("class");
                    if (sel_class !== item && sel_class !== "Select country for filter") {
                        $( this ).css({"display" : "none"});
                    } else if (sel_class == "Select country") {
                        $( this ).css({"display" : "table-row"});
                    } else {
                        $( this ).css({"display" : "table-row"});
                    }
                });
            })
            .change();
    } );
})(jQuery);