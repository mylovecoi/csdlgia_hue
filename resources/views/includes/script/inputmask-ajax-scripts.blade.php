<script type="text/javascript" src="{{ url('js/jquery.inputmask.bundle.min.js') }}"></script>
<script>
    function InputMask() {
        //$(function(){
        // Input Mask
        if ($.isFunction($.fn.inputmask)) {
            $("[data-mask]").each(function (i, el) {
                var $this = $(el),
                        mask = $this.data('mask').toString(),
                        opts = {
                            numericInput: attrDefault($this, 'numeric', false),
                            radixPoint: attrDefault($this, 'radixPoint', ''),
                            rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                        },
                        placeholder = attrDefault($this, 'placeholder', ''),
                        is_regex = attrDefault($this, 'isRegex', '');


                if (placeholder.length) {
                    opts[placeholder] = placeholder;
                }

                switch (mask.toLowerCase()) {
                    case "phone":
                        mask = "(999) 999-9999";
                        break;

                    case "currency":
                    case "rcurrency":

                        var sign = attrDefault($this, 'sign', '$');
                        ;

                        mask = "999,999,999.99";

                        if ($this.data('mask').toLowerCase() == 'rcurrency') {
                            mask += ' ' + sign;
                        }
                        else {
                            mask = sign + ' ' + mask;
                        }

                        opts.numericInput = true;
                        opts.rightAlignNumerics = false;
                        opts.radixPoint = '.';
                        break;

                    case "email":
                        mask = 'Regex';
                        opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
                        break;

                    case "password":
                        mask = 'Regex';
                        opts.regex = "[a-zA-Z0-9._%-]{8,30}";
                        break;

                    case "username":
                        mask = 'Regex';
                        opts.regex = "[a-zA-Z0-9._-]{2,15}";
                        //alert(opts.regex);
                        break;

                    case "fdecimal":
                        mask = 'decimal';
                        $.extend(opts, {
                            autoGroup: true,
                            groupSize: 3,
                            radixPoint: attrDefault($this, 'rad', '.'),
                            groupSeparator: attrDefault($this, 'dec', ','),
                            placeholder: "0",
                            clearMaskOnLostFocus: false
                        });
                }

                if (is_regex) {
                    opts.regex = mask;
                    mask = 'Regex';
                }

                $this.inputmask(mask, opts);
            });
        }
        //});
    }
    function attrDefault($el, data_var, default_val)
    {
        if(typeof $el.data(data_var) != 'undefined')
        {
            return $el.data(data_var);
        }

        return default_val;
    }
</script>