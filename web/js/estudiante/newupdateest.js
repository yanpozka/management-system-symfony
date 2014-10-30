$(document).ready(function() {
    var $area_encuentro = $('#area_encuentro')
    $area_encuentro.find('input,textarea').removeAttr('required')
    //Validation
//            $("form").validate({
//                submitHandler: function (form) {
//                    form.submit()
//                }
//            })
    var tipo_encuentro = '#gepedag_estudiantebundle_estudiante_tipoCurso_1'
    var tipo_diurno = '#gepedag_estudiantebundle_estudiante_tipoCurso_0'

    $(tipo_encuentro).click(function() {
        if ($(this).is(':checked')) {
            $area_encuentro.show('normal', function() {
                $area_encuentro.fadeIn('normal')
            })
            $area_encuentro.find('input,textarea').each(function(i, elem) {
                var $self = $(elem);
                if (!$self.hasClass('select2-input') && !$self.hasClass('select2-focusser')
                        && !$self.hasClass('select2-offscreen'))
                    $self.attr('required', 'required')
            })
        }
    })
    $(tipo_diurno).click(function() {
        if ($(this).is(':checked')) {
            $area_encuentro.hide('normal', function() {
                $area_encuentro.fadeOut('normal')
            })
            $area_encuentro.find('input,textarea').removeAttr('required')
        }
    })

    $('#btn_enviar').bind('click', function(e) {
        console.info('***** SE DIO CLICK SABROSO AL SUBMIT  *****')
        var ok = true
        $('#area_encuentro input[type="text"],textarea').css('border', '0')
        $('#area_encuentro input[type="text"],textarea').each(function() {
            var $self = $(this)
            if ($self.hasClass('select2-input') && !$self.hasClass('select2-focusser')
                    && !$self.hasClass('select2-offscreen'))
                return true
            if ($self.attr('required') == 'required' && $self.val() == "") {
                console.info('Este falló y carece de proyectiles:')
                console.log($self.attr('id'))
                console.log($self)
                $self.css('border', '1px solid red')
                $self.focus()
                return  (ok = false)
            }
        })
        if (ok) {
            $('form').submit()
            e.stopPropagation()
            return false
        }
    })
})