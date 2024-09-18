
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) { window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    console.log('hello');
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({ filter: filterValue });
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/ //*Incremento y decremento de los input´s para la cantidad del producto
    $('.btn-num-product-down').on('click', function () {
        let $input = $(this).next(); // Selecciona el campo de entrada
        let numProduct = Number($input.val());

        if (numProduct > 1) {
            $input.val(numProduct - 1);
        }
    });

    $('.btn-num-product-up').on('click', function () {
        let $input = $(this).prev(); // Selecciona el campo de entrada
        let numProduct = Number($input.val());
        let maxStock = Number($input.attr('max'));
        let maxStockparse = maxStock - 1;


        if (numProduct < maxStockparse) {
            $input.val(numProduct + 1);
        }
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        let item = $(this).find('.item-rating');
        let rated = -1;
        let input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            let index = item.index(this);
            let i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            let index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            let i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });


    //Los que se estan utilizando
    document.querySelectorAll('.js-show-modal1').forEach(function (button) {
        button.addEventListener('click', function (event) {
            $('.wrap-modal1').addClass('show-modal');
            //event.preventDefault();
        });
    });

    $('.js-hide-modal1').on('click', function () {
        $('.wrap-modal1').removeClass('show-modal');
    });


    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form-agregar-carrito');
        const isAuthenticated = form.getAttribute('data-authenticated') === 'true';

        form.addEventListener('submit', function (event) {
            if (!isAuthenticated) {
                event.preventDefault();
                $('#loginModal').modal('show'); // Asumiendo que tienes un modal de Bootstrap con ID 'loginModal'
            }
        });
    });


    $(document).ready(function () {
        $('#form-agregar-carrito').on('submit', function (e) {
            e.preventDefault(); // Evita que el formulario se envíe de la manera tradicional
            let url = $(this).attr('action');
            let datos = $(this).serialize();

            let color = $('#color').val();
            let talla = $('#talla').val();

            // Verifica si color y talla están vacíos
            if (!color || !talla) {
                return;
            }

            $.ajax({
                type: 'POST',
                url: url, // Usa la URL definida en el action del formulario
                data: datos, // Serializa todos los datos del formulario
                success: function () {

                    $('#form-agregar-carrito')[0].reset();
                    $('.js-select2').val('').trigger('change');
                },

            });
        });
    });



    //* Carga la información obtenida de la base en el modal del carro de compras

    
    $(document).ready(function () {
        $('.js-show-cart').on('click', function () {
            let userId = $(this).data('id-usuario');
            let url = $(this).data('url');
            if (userId) {
                // Enviar el ID del usuario al servidor mediante AJAX
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { usu_id: userId },
                    success: function (response) {
                        // Suponiendo que la respuesta es JSON y contiene los productos
                        let productos = response.productos;

                        // Limpiar la lista actual del carrito
                        $('.header-cart-wrapitem').empty();

                        let total = 0;
                        let precio = 0.0;
                        let colorPrenda = "";
                        let tallaPrenda = "";
                        let urlFoto = "";

                        let formatter = new Intl.NumberFormat('es-CO', {
                            style: 'currency',
                            currency: 'COP',
                            minimumFractionDigits: 0
                        });

                        let cantidadProductosUnicos = 0;
                        // Recorrer los productos y agregar cada uno al carrito
                        productos.forEach(function (item) {
                            let producto = item.producto;
                            let stock = item.stock;
                            let fotos = item.fotosProd;
                            stock.forEach(element => {

                                precio = element.stock_precio;
                                colorPrenda = element.stock_color;
                                tallaPrenda = element.stock_talla;

                            });
                            fotos.forEach(element => {

                                urlFoto = element.foto_img;
                                return
                            });

                            let itemHtml = `
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="${urlFoto}" alt="IMG">
                                </div>
                                <div class="header-cart-item-txt p-t-8">
                                    <a class="header-cart-item-name m-b-5 hov-cl1 trans-04">
                                        ${producto.product_nombre}
                                    </a>
                                    <span class="header-cart-item-info">
                                        ${item.cantidad} x ${formatter.format(precio)}
                                    </span>
                                    <span class="header-cart-item-txt p-t-5">
                                        color :${colorPrenda}
                                    </span>
                                    <span class="header-cart-item-info">
                                        talla : ${tallaPrenda}
                                    </span>
                                </div>
                            </li>`;

                            $('.header-cart-wrapitem').append(itemHtml);

                            // Actualizar el total
                            total += precio * item.cantidad;
                            cantidadProductosUnicos++;
                        });



                        // Actualizar el total en el HTML
                        $('.header-cart-total').text(`Total: ${formatter.format(total)}`);
                        $('.icon-header-item.icon-header-noti').attr('data-notify', cantidadProductosUnicos);

                        // Mostrar el panel del carrito
                        $('.js-panel-cart').addClass('show-header-cart');
                    },
                    error: function (error) {
                        console.error('Error al obtener los productos del carrito:', error);
                    }
                });
            } else {
                console.error('No se encontró el ID del usuario.');
            }
        });
    });


    //* Actualiza el precio total por todos los productos en el detalle del carro de compras:

    $(document).ready(function () {
        function actualizarEstadoBotones() {
            $('.wrap-num-product').each(function () {
                let inputCantidad = $(this).find('.num-product');
                let cantidadActual = parseInt(inputCantidad.val());
                let maxValue = parseInt(inputCantidad.attr('max'));
                let btnUp = $(this).find('.btn-num-product-up');

                if (!isNaN(cantidadActual) && cantidadActual >= maxValue) {
                    btnUp.prop('disabled', true); // Deshabilitar el botón
                } else {
                    btnUp.prop('disabled', false); // Habilitar el botón
                }
            });
        }

        $('.btn-num-product-up').on('click', function () {
            let inputCantidad = $(this).closest('.wrap-num-product').find('.num-product');
            let cantidadActual = parseInt(inputCantidad.val());
            let maxValue = parseInt(inputCantidad.attr('max'));


            if (!isNaN(cantidadActual) && cantidadActual < maxValue) {
                actualizarTotalProducto(inputCantidad); // Actualizar total para ese producto
                actualizarEstadoBotones(); // Actualizar el estado de los botones
            } else {
                alert('No puedes agregar más productos. Has alcanzado el límite de stock.');
                return;
            }
        });

        $('.btn-num-product-down').on('click', function () {
            let inputCantidad = $(this).closest('.wrap-num-product').find('.num-product');
            let cantidadActual = parseInt(inputCantidad.val());
            let minValue = parseInt(inputCantidad.attr('min'));

            if (!isNaN(cantidadActual) && cantidadActual > minValue) {
                actualizarTotalProducto(inputCantidad); // Actualizar total para ese producto
                actualizarEstadoBotones(); // Actualizar el estado de los botones
            }
        });

        function actualizarTotalProducto(inputCantidad) {
            let cantidad = parseFloat(inputCantidad.val());

            if (!isNaN(cantidad) && cantidad > 0) {
                let precio = parseFloat(inputCantidad.closest('tr').find('.precio').data('precio'));
                let totalProducto = cantidad * precio;

                inputCantidad.closest('tr').find('.total-producto').text(totalProducto.toLocaleString());
                actualizarTotal();
            }
        }

        function actualizarTotal() {
            let totalPrecio = 0.0;

            $('.table_row').each(function () {
                let precio = parseFloat($(this).find('.precio').data('precio'));
                let cantidad = parseInt($(this).find('.num-product').val());

                if (!isNaN(cantidad) && cantidad > 0) {
                    let totalProducto = precio * cantidad;
                    totalProducto = Math.round(totalProducto);
                    $(this).find('.total-producto').text(totalProducto.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
                    totalPrecio += totalProducto;
                }
            });

            totalPrecio = Math.round(totalPrecio);
            $('#total-precio').text(totalPrecio.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ','));
        }

        actualizarEstadoBotones();
    });










    //*Para traer las tallas dependiendo el color

    $(document).ready(function () {
        // Escuchar el evento de cambio en el select de color
        $('select[name="color"]').change(function () {
            let colorSeleccionado = $(this).val(); // Obtener el valor seleccionado
            let url = $(this).attr('data-url'); // Obtener la URL del atributo data-url
            let productId = $(this).data('product-id'); // Obtener el ID del producto del atributo data-product-id

            // Solo hacer la petición si se selecciona un color
            if (colorSeleccionado !== '') {


                // Hacer la solicitud AJAX al controlador
                $.ajax({
                    url: url, // La URL donde se encuentra el controlador
                    type: 'GET', // El método de la solicitud (GET o POST)
                    dataType: 'json',
                    data: { color: colorSeleccionado, product_id: productId }, // Enviar el color y el ID del producto al controlador
                    success: function (response) {

                        // Intentar parsear la respuesta a JSON
                        try {
                            // Limpiar las opciones de talla anteriores
                            $('select[name="talla"]').empty();

                            // Añadir una opción por defecto
                            $('select[name="talla"]').append('<option value="">Escoge una Talla</option>');

                            // Recorrer las tallas y agregarlas como opciones
                            $.each(response, function (index, talla) {
                                $('select[name="talla"]').append('<option value="' + talla + '">' + talla + '</option>');
                            });
                        } catch (e) {
                            console.error('Error al parsear el JSON:', e);
                            console.log('Respuesta recibida (no es JSON válido):', response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log('Error en la solicitud:', error);
                    }
                });
            } else {
                // Limpiar las tallas si no se selecciona un color
                $('select[name="talla"]').empty();
                $('select[name="talla"]').append('<option value="">Escoge una Talla</option>');
            }
        });
    });




    //*Retorna el valor del envío dependiendo de la ciudad

    $(document).ready(function () {
        // Escuchar el evento de cambio en el select de ciudad usando jQuery
        $('#select-ciudad').on('change', function () {
            console.log('Evento change disparado'); // Para verificar si el evento se dispara

            let ciu_id = $(this).val(); // Obtener el valor seleccionado con jQuery
            let url = $(this).data('url'); // Obtener la URL del atributo data-url
            let totalConEnvio = 0.0;

            let formatter = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            });

            // Solo hacer la petición si se selecciona una ciudad
            if (ciu_id) {
                // Hacer la solicitud AJAX al controlador
                $.ajax({
                    url: url, // La URL donde se encuentra el controlador
                    type: 'POST', // El método de la solicitud (POST)
                    dataType: 'json',
                    data: { ciu_id: ciu_id }, // Enviar el ID de la ciudad al controlador
                    success: function (response) {
                        console.log('Respuesta completa del servidor:', response);

                        // Verifica que el array 'precioEnvio' contenga al menos un elemento
                        if (response.precioEnvio && response.precioEnvio.length > 0) {
                            // Acceder al primer elemento del array y luego al campo 'ciu_precioenvio'
                            let precioEnvio = response.precioEnvio[0].ciu_precioenvio;



                            // Actualizar el campo del valor de envío con el precio obtenido
                            $('#valor-envio').val(formatter.format(precioEnvio) || 'No disponible');
                            let totalProducto = parseFloat($('#total-precio').text().replace(/,/g, '')) || 0;
                            let precioEnvioconver = parseFloat(precioEnvio);


                            // Calcular el nuevo total sumando el valor del envío
                            totalConEnvio = totalProducto + precioEnvioconver;
                            console.log(totalConEnvio);
                               // Actualizar el campo oculto con el total
                            $('#total-con-envio').val(totalConEnvio);

                            $('.size-209.p-t-1 .mtext-110.cl2').text(formatter.format(totalConEnvio));

                        } else {
                            console.log('No se encontró información para el envío.');
                            $('#valor-envio').val('No disponible');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error en la solicitud:', error);
                        $('#valor-envio').val(''); // Usar jQuery para cambiar el valor en caso de error
                    }
                });
            } else {
                // Limpiar el valor si no se selecciona una ciudad
                $('#valor-envio').val('');
            }
        });
    });








    //

})(jQuery);

