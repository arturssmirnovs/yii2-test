if(POST==undefined){var POST={};}

POST.fieldCloner = function() {
    this.init = function () {
        $(".btn-clone-target").each(function (index, element) {
            let field = new POST.field(element);
            field.init();
        });
    }

    this.clone = function(target) {
        let parent = $(target).prev('.btn-clone-target');

        let cloned = parent.clone();

        $(cloned).find('.datepicker').removeClass('hasDatepicker').removeAttr('id').datepicker({"dateFormat":"yy-mm-dd"});

        $(cloned).find('input, select, textarea').each(function (index, element) {
            let parts = $(element).attr('name').match(/\[([0-9])\]/);

            let number = parseInt(parts[1])+1;

            let newName = $(element).attr('name').replace(parts[0], '['+number+']');

            $(element).attr('name', newName);

            $(element).val(null);
        });

        cloned.insertBefore(event.target);

        let field = new POST.field(cloned);
        field.init();
    }
}

POST.field = function(element) {

    this.element = element;

    this.init = function() {
        $(this.element).find('.btn-close').on("click", function (event) {
            this.remove($(event.target).parent('.btn-clone-target'));
        }.bind(this));
    }

    this.remove = function(row) {
        this.element.remove();
    }
}

$( document ).ready(function() {

    var cloner = new POST.fieldCloner();

    cloner.init();

    $(".btn-clone").on("click", function (event) {
        cloner.clone(event.target);
    });

});