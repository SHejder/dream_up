// var jQuery = jQuery;
// console.log(jQuery);
var scrollComponent = (function(){

    var scrollPosition = {
        current : 0,
        previous : 0,
        backup : 0
    };

    // PRIVATE =========================================================================================================

    scrollCheck = function () {
        scrollPosition.previous = scrollPosition.current;
        scrollPosition.current = document.documentElement.scrollTop || window.pageYOffset || window.scrollY;
    };

    /* scroll to */
    scrollMoveTo = function (position) {
        window.scrollTo( 0, position );
    };

    /* save scroll position */
    scrollSave = function () {
        scrollPosition.backup = document.documentElement.scrollTop || window.pageYOffset || window.scrollY;
    };

    /* scroll enable */
    scrollEnable = function () {
        document.body.style.overflowY = '';
        document.body.style.position = '';
    };

    /* scroll disable */
    scrollDisable = function () {
        document.body.style.overflowY = 'hidden';
        document.body.style.position = 'fixed';
    };

    /* return down || up */
    scrollDirection = function () {
        return ( scrollPosition.current >= scrollPosition.previous ) ? 'down' : 'up';
    };


    // INIT ============================================================================================================

    scrollCheck();
    window.addEventListener('scroll', function() {
        scrollCheck();
    });


    // PUBLIC ==========================================================================================================

    return {
        current : function(value){
            if(typeof value !== "undefined"){
                scrollMoveTo(value);
                scrollCheck();
            }
            else {
                scrollCheck();
                return scrollPosition.current;
            }
        },
        direction : function(){ return scrollDirection() },
        enable : function(){
            scrollEnable();
            scrollMoveTo(scrollPosition.backup);
        },
        disable : function(){
            scrollSave();
            scrollDisable();
        }
    }
}());
var app = {
    helper : {
        scroll : scrollComponent
    },
    ui : {
        components : {

        }
    }
};
function MediaEventListener(queryOption){
    var _self = this;
    _self.resolutionCurr = window.innerWidth;
    _self.resolutionLast = 0;
    // default device breakpoints или из опций при инициализации
    _self.queries = (typeof queryOption !== undefined) ? queryOption :[
        {
            name: 'mobile',
            minResolution: 0,
            maxResolution: 419,
            isActive: false,
            isEach: false,
            callback: []
        },
        {
            name: 'landscape',
            minResolution: 420,
            maxResolution: 1023,
            isActive: false,
            isEach: false,
            callback: []
        },
        {
            name: 'desktop',
            minResolution: 1024,
            maxResolution: 1920,
            isActive: false,
            isEach: false,
            callback: []
        },
        {
            name: 'each-resize',
            minResolution: 0,
            maxResolution: 19200,
            isActive: false,
            isEach: true,
            callback: []
        }
    ];

    // добавление функций на разные разрешения
    _self.addQueryAction = function(queryName, func){
        _self.queries.forEach(function(item){
            if( item.name === queryName){
                item.callback.push(func);
            }
        });
    };

    // выполняем скрипты для перехода на конкретное разршенеие
    _self.doQueryAction = function(queryName){
        _self.queries.forEach(function(item){
            // ищем нужное разрешение
            if( item.name === queryName){
                // запускаем все колбэки
                item.callback.forEach(function(item){ item(); });
            }
        });

    };

    // проверка активных медиа запросов
    _self.resize = function () {
        // определяем текущее разрешение
        _self.resolutionCurr = window.innerWidth;
        // проходим по всем разрешениям
        _self.queries.forEach(function(screen){
            if( screen.minResolution <= _self.resolutionCurr && _self.resolutionCurr <= screen.maxResolution ){

                // выполняем подвешеные скрипты, если на этом разрешение их нужно выполнять при каждом ресайзе
                if(screen.isEach){ _self.doQueryAction(screen.name); }

                // если сменилось на активное, то выполняем подвешеные скрипты
                if(!screen.isActive && !screen.isEach){ _self.doQueryAction(screen.name); }
                screen.isActive = true;

            } else {
                // иначе переключаем флаг, если разрешение неактивно
                screen.isActive = false;
            }
        });
        // запоминаем разрешение
        _self.resolutionLast =  _self.resolutionCurr;

    };

    // инициализация
    _self.init = function(){
        // запускаем проход по всем разрешениям для первой загрузки
        _self.resize();
        // и вешаем обработчик на все последущюие ресайзы
        window.onresize =  function resize(){
            _self.resize();
        }

    };

    _self.debug = function () {
        console.log( _self.queries );
    };

}





(function( jQuery ){

    var defaults = {
        // дефолтные опции
        minResolution: 1000
    };
    var states ={
        hasExtra: false
    };

    var methods = {

        init : function( options ) {

            options = jQuery.extend({}, defaults, options);

            this.each(function() {

                var container = jQuery(this);
                var menuRoot = jQuery(this).find('ul').not('ul ul');
                var menuItems = menuRoot.find('li').not('li li');
                var containerWidth = menuRoot.width();
                // тут код
                console.log('menuSmart', menuItems);

                methods.addExtraBar(menuRoot, menuItems);

                containerWidth = menuRoot.width();
                methods.hideItem(menuRoot, menuItems, containerWidth)

                window.addEventListener("resize", function() {
                    containerWidth = menuRoot.width();
                    if(containerWidth > options.minResolution){
                        methods.hideItem(menuRoot, menuItems, containerWidth);
                    }
                });

            });
        },

        resize : function () {

        },

        addExtraBar: function (menuRoot, menuItems) {
            var extrabarContent = '';
            for(var i = 0; i < menuItems.length; i++){
                extrabarContent = extrabarContent + menuItems.eq(i).get(0).outerHTML;
            }

            menuRoot.append(
                '<li class="menu-top__item -extraBar -has-drop-down -drop-down-inverse">' +
                    '<button class="menu-top__item-name">...</button>' +
                    '<div class="menu-top__drop-down">' +
                        '<ul class="menu-top__list">' +
                            extrabarContent +
                        '</ul>' +
                    '</div>' +
                '</li>'
            );
            menuRoot.find('.-extraBar .menu-top__drop-down .menu-top__drop-down').remove();
        },

        // удаляет дополнительную выпадашку
       removeExtraBar : function (menuRoot) {
           menuRoot.find('.-extraBar').remove();
       },


        // проверяет элементы, если элементу не хватает места, то скрывает его
        hideItem : function (menuRoot, menuItems, containerWidth) {
            // подготавливаем выпадашку дублёра
            var dubler = menuRoot.find('.-extraBar');
            var dublerList = dubler.find('.menu-top__item');
            console.log(dublerList);
            dubler.removeClass('-hidden');
            menuItems.removeClass('-hidden');

            var width = containerWidth;
            var sumWidth = 0;
            states.hasExtra = false;
            for(var i = 0; i < menuItems.length; i++){
                var elWidth = menuItems.eq(i).width();

                if(sumWidth + elWidth < width){
                    // если следующий элемент не влазит
                    sumWidth = sumWidth + elWidth;
                    dublerList.eq(i).addClass('-hidden');


                } else {
                    // если элемент влазит
                    // проверяем влезет ли гамбургер
                    if(sumWidth + elWidth < width){

                    }

                    menuItems.eq(i).addClass('-hidden');
                    states.hasExtra = true;
                }
            }

        }

    };

    jQuery.fn.menuSmart = function(method) {

        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            jQuery.error( 'Метод ' +  method + ' не существует в jQuery.menuSmart' );
        }

    };

})( jQuery );
function initMenuMobile(id, data) {

    var menuMobile = new Vue({
        el: '#menu-mobile-' + id,
        data: {
            el: '#menu-mobile-' + id,
            tree: data,
            activeNode: {
                id: data[0].id,
                name: data[0].name,
                parentId: data[0].parentId
            },
            show: false
        },
        template:
            '<transition name="menu-mobile-toggle" mode="out-in">' +
            '<div class="menu-mobile" id="menu-mobile-' + id + '" v-if="show">' +
                '<menu-mobile-header v-bind:node="activeNode"></menu-mobile-header>' +
                '<ul class="menu-mobile__list">' +
                    '<template  v-for="item in tree">' +
                        '<menu-mobile-item v-if="item.parentId === activeNode.id" v-bind:item="item" :key="item.id" ></menu-mobile-item>' +
                    '</template>' +
                '</ul>' +
            '</div>' +
            '</transition>',
        methods: {
            getNodeParam: function (input) {
                var result = {};
                result.id =  input.id;
                result.name =  input.name;
                result.parentId =  input.parentId;
                return result;
            },
            closeMenu: function () {
                // jQuery( this.el).hide();
                this.activeNode = menuMobile.getNodeParam( this.tree[0] );
                app.helper.scroll.enable();
                this.show = false;
            }
        },
        components: {
            'menu-mobile-header': {
                props: ['node'],
                template:
                    '<transition name="menu-mobile-header-toggle">' +
                    '<div class="menu-mobile__header">' +
                        '<div class="menu-mobile__title">' +
                            '<button class="menu-mobile__title-btn" :data-node="node.id" v-on:click.prevent="activeParentNode">' +
                                '<i class="menu-mobile__icon-arrow-right" v-if="node.id"></i>' +
                                '{{ node.name }}' +
                            '</button>' +
                        '</div>' +
                        '<button class="menu-mobile__switcher-btn" v-on:click.prevent="closeMenu"><span></span></button>' +
                    '</div>' +
                    '</transition>',
                methods: {
                    closeMenu: function (event) {
                        menuMobile.closeMenu();
                    },
                    activeParentNode: function (event) {
                        if( this._props.node.parentId !== null ){
                            var parentId = this._props.node.parentId;
                            for(var i = 0; i < menuMobile.tree.length; i++){
                                if (menuMobile.tree[i].id === parentId) {
                                    menuMobile.activeNode = menuMobile.getNodeParam( menuMobile.tree[i] );
                                }
                            }
                        } else {
                            menuMobile.closeMenu();
                        }

                    }
                }
            },
            'menu-mobile-item': {
                props: ['item', 'activeNode'],
                template:
                    '<transition name="menu-mobile-item-show" mode="out-in">' +
                    '<li class="menu-mobile__item">' +
                        '<a class="menu-mobile__item-name" v-bind:href="item.href">' +
                            '{{ item.name }}' +
                            // иконка со стрелкой, для элементов без потомков
                            '<span v-if="!item.hasChild" class="menu-mobile__item-btn">' +
                                '<i class="menu-mobile__icon-arrow-left"></i>' +
                            '</span>' +
                        '</a>' +
                        // для элементов с подкатегориями добавляем кнопочку показывающую эти подразделы
                        '<button v-if="item.hasChild" class="menu-mobile__item-btn hasChild"  v-on:click.prevent="showChild">' +
                            '<i class="menu-mobile__icon-more"></i>' +
                        '</button>' +
                    '</li>' +
                    '</transition>',
                methods: {
                    showChild: function (event) {
                        menuMobile.activeNode = menuMobile.getNodeParam( this._props.item );
                    }
                }
            }
        }
    });

    return menuMobile;
}



// dependencies
// - bower_components/jquery/dist/jquery.js
// - bower_components/vue/dist/vue.js
// - web/assets/ui-kit/components/modal/modal-core.js
// - web/assets/ui-kit/components/menu-mobile/menu-mobile.vue.component.js
//
// Example
// <nav class="js-menu-mobile">
//
//     <button data-menu-mobile--switcher-btn>menu</button>
//
//     <ul data-menu-mobile--root>
//         <li data-menu-mobile--has-drop-down><a data-menu-mobile--item-name>Пунк 1</a>
//             <div>
//                 <ul>
//                     <li><a data-menu-mobile--item-name>Пунк 1.1</a></li>
//                     <li><a data-menu-mobile--item-name>Пунк 1.2</a></li>
//                     <li><a data-menu-mobile--item-name>Пунк 1.3</a></li>
//                     <li><a data-menu-mobile--item-name>Пунк 1.4</a></li>
//                     <li><a data-menu-mobile--item-name>Пунк 1.5</a></li>
//                 </ul>
//             </div>
//         </li>
//         <li><a data-menu-mobile--item-name>Пунк 2</a></li>
//         <li><a data-menu-mobile--item-name>Пунк 3</a></li>
//         <li><a data-menu-mobile--item-name>Пунк 4</a></li>
//         <li><a data-menu-mobile--item-name>Пунк 5</a></li>
//         <li><a data-menu-mobile--item-name>Пунк 6</a></li>
//     </ul>
//
// </nav>


function MenuMobile(options){

    // Дерево меню, включает в себя только узлы, листья игнорируются


    var text = {
        rootTitle: 'Меню'
    };

    var selectors = {
        container: '.js-menu-mobile',
        nodeRoot: '[data-menu-mobile--root]',
        nodeLink: '[data-menu-mobile--item-name]',
        node: 'data-menu-mobile--has-drop-down',
        btnToggle: '[data-menu-mobile--switcher-btn]'
    };

    var id = Math.round( Math.random()*10000);


    // переопределяем переменные если надо ============================================================================/

    // переопределяем свойства, если это необходимо
    function setOptions(container){
        // text = jQuery.extend({}, selectors, options.text);
        // selectors = jQuery.extend({}, selectors, options.selectors);
        text.rootTitle = jQuery(container).find(selectors.btnToggle).text();
    }

    // работа с деревом ===============================================================================================/

    function buildMenu(nodeRoot){
        var tree = [];
        var _id = 0;
        // задаём корень
        tree.push({ id: _id, name: text.rootTitle, elementLink: nodeRoot, hasChild: true, parentId: null });
        // рекурсивно строим остальное дерево
        function build(parentNode){
            var parent = jQuery(parentNode.elementLink);
            var el = parent.find('li').not( parent.find('li li'));
            el.each(function () {
                _id++;
                var currNode = {
                    id: _id,
                    name: jQuery(this).children(selectors.nodeLink).text(),
                    href: jQuery(this).children(selectors.nodeLink).attr('href'),
                    elementLink: jQuery(this),
                    hasChild:  jQuery(this).attr(selectors.node) != null,
                    parentId: parentNode.id
                };
                tree.push(currNode);
                if(currNode.hasChild){  build(currNode) }
            });
        }
        build( getNodeRoot(tree) );

        return tree;
    }

    function renderMenu(tree){
        // console.log(tree);
        jQuery('body').append('' +
            '<menu-mobile class="menu-mobile" id="menu-mobile-' + id + '"></menu-mobile>'
        );
        var vueMenuMobile = initMenuMobile(id, tree);
        return vueMenuMobile;
    }

    // вспомогательные ================================================================================================/

    // Получения узла по ID
    function getNodeById(id, tree){
        var result = null;
        //ищем элемент с заданным id
        tree.forEach(function(item){
            if( item.id == id ){
                result = item;
                return false;
            }
        });
        // если элемента с таким id нет, то возвращаем null
        return result;
    }

    // Получения корня
    function getNodeRoot(tree){
        return getNodeById(0, tree);
    }


    // Обработка событий ==============================================================================================/

    function addHandlerToggleBtn(container, vueMenuMobile){
        jQuery(container).on('click', selectors.btnToggle, function () {
            vueMenuMobile.show = true;
            app.helper.scroll.disable();
        });
    }

    // initialize =====================================================================================================/
    jQuery(selectors.container).each(function () {
        setOptions(jQuery(this));  // переопределяем свойства, если это необходимо
        var tree = buildMenu(jQuery(this).find(selectors.nodeRoot));  // создаём модель меню
        var vueMenuMobile = renderMenu(tree);   // ренедерим меню, колбэком навешиваем обработчики
        addHandlerToggleBtn(this, vueMenuMobile);
    });

    // public =========================================================================================================/
    return {
        init: function () {
            
        }
    };
}

(function( jQuery ){
	
	var defaults = {
        className: '',           			// дополнительный класс если нужен
		minValue: 0,            			// минимальное допустимое значение
		maxValue: 1000,          	 		// максимально допустимое значение
		speedChange: 100,       	 		// скорость изменения значений (мс)
		stepValue: 1,          	 			// шаг значения 
		
		/*пока не работает*/
		defaultValue: 0,          	 		// значение по умолчанию, если не задано
		
		onChange: function(){ }, 			// функция вполняемая после каждого изменения значения инпута
		onFinalChange: function(){ } 		// функция вполняемая после последнего изменения значения инпута
    };	
	
	var methods = {
	
		init : function( options ) { 

			options = jQuery.extend({}, defaults, options);
			
			this.each(function() {

				var timer;
				
				jQuery(this).wrap("<div class='customNumber " + options.className + "'></div>");
				jQuery(this).after("<span class='plus'>+</span><span class='minus'>-</span>");
				
				var container = jQuery(this).parent('.customNumber');
				var input = jQuery(container).find('input');
				var minus = jQuery(container).find('.minus');
				var plus = jQuery(container).find('.plus');
				
				jQuery(minus).on('mousedown', function () {
					var data = input.val()*1;
					if(data > options.minValue){
						input.val(data - options.stepValue).change();
						data = data - options.stepValue;
						options.onChange();
					}
					timer = setInterval(function(){ 
						if(data > options.minValue){
							input.val(data - options.stepValue).change();
							data = data - options.stepValue;
							options.onChange();
						}
					}, options.speedChange);
				});
				
				jQuery(plus).on('mousedown', function () {
					var data = input.val()*1;
					if(data < options.maxValue){
						input.val(data + options.stepValue).change();
						data = data + options.stepValue;
						options.onChange();
					}
					timer = setInterval(function(){ 
						if(data < options.maxValue){
							input.val(data + options.stepValue).change();
							data = data + options.stepValue;
							options.onChange();
						}
					}, options.speedChange); 
				});
				
				jQuery(container).find('span').on('mouseup mouseleave', function () {	
					clearInterval(timer);
					options.onFinalChange();
				});

				
			});
		}
		
	};
	 
	jQuery.fn.customNumber = function(method) {

		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			jQuery.error( 'Метод ' +  method + ' не существует в jQuery.customNumber' );
		}    

	};
 
})( jQuery );
var Tables = (function(){

    // private =============================================================
    wrapTables = function (tableSelector){
        jQuery(tableSelector).each(function () {
            var currTable = jQuery(this);
            // var className = "table-responsive";
            // if(currTable.attr('data-view-type') == 'horizontal'){ className += ' -horizontal'; }
            currTable.wrap("<div class='table-responsive'><div class='table-responsive__scroll'></div></div>");
        })
    };

    // public =============================================================
    return {
        addMobileView: function(tableSelector){
            wrapTables(tableSelector);
        }
    };
}());
// js-spoiler-area - скрывает область под спойлер
//
// исходный код
// <div class="js-spoiler-area hidden-md"
// data-mobile-only="true"
// data-text-opened="Скрыть"
// data-text-closed="Показать полностью">
//  <!-- тут контент который нужно скрывать -->
// </div>

//  сегнерированый код
//  <div class="spoiler">
//      <div  class="spoiler js-spoiler-area"><!-- тут контент который нужно скрывать --></div>
//      <button class="spoiler__btn" ><span>Btn</span></button>
//  </div>

jQuery('.js-spoiler-area').each(function () {

    var self = jQuery(this);

    // кэшируем data-атрибуты, подставляя значения по умолчанию, если атрибуты не заданы
    var btnTextOpened = self.attr('data-text-opened') ? self.attr('data-text-opened') : 'Скрыть',
        btnTextClosed = self.attr('data-text-closed') ? self.attr('data-text-closed') : 'Посмотреть весь текст',
        btnClass = self.attr('data-btn-class') ? self.attr('data-btn-class') : '' ;

    // добавляем необходимый html
    self.addClass('spoiler__content');
    self.wrap('<div class="spoiler"></div>');
    self.parent().append('<button class="spoiler__btn btn ' + btnClass + '"><span>' + btnTextClosed + '</span></button>');

    // кэшируем элементы
    var container = self.parent(),
        content = self,
        btn = container.find('.spoiler__btn');


    // добавляем класс hidden-*/visible-* для кнопки если надо
    // класс добавляется, если у контента есть класс hidden-*
    var classList = content.attr('class').split(/\s+/),
        isResponse = false;
    jQuery.each(classList, function(index, item) {
        if (item.substring(0,7) === 'hidden-') {
            btn.addClass('hidden visible-' + item.substring(7,9));
            isResponse = true;
        }
    });
    if(!isResponse){
        content.addClass('hidden');
    }

    // вешаем события
    btn.on('click', function(){
        content.slideToggle();
        btn.toggleClass('is-opened');
        if(btn.hasClass('is-opened')){
            btn.find('span').text(btnTextOpened);
        } else {
            btn.find('span').text(btnTextClosed);
        }
    });
});


jQuery('.js-spoiler-items').each(function () {

    var self = jQuery(this);

    // кэшируем data-атрибуты, подставляя значения по умолчанию, если атрибуты не заданы
    var btnTextOpened = self.attr('data-text-opened') ? self.attr('data-text-opened') : 'Скрыть',
        btnTextClosed = self.attr('data-text-closed') ? self.attr('data-text-closed') : 'Смотреть полностью',
        btnClass = self.attr('data-btn-class') ? self.attr('data-btn-class') : '' ;

    // добавляем необходимый html
    self.addClass('spoiler__content');
    self.wrap('<div class="spoiler"></div>');
    self.parent().append('<button class="spoiler__btn btn ' + btnClass + '"><span>' + btnTextClosed + '</span></button>');


});
console.time('appjs');
/*=========================================================================*/
/* mediaEventListener кастомизируем breakpoint'ы */
var mediaEventListener = new MediaEventListener([
    { name: 'mobile',  minResolution: 0,    maxResolution: 980,  isActive: false, isEach: false, callback: [] },
    { name: 'desktop', minResolution: 981, maxResolution: 1920,  isActive: false, isEach: false, callback: [] },
    { name: 'resize',  minResolution: 0,    maxResolution: 19200, isActive: false, isEach: true,  callback: [] }
]);


/*=========================================================================*/
/* задаём каим именно табилцам нужно добавлять обертки .table-responsive для адаптива */
Tables.addMobileView('table');


// console.time('SmartMenu');
//
// var menuMobile = new MenuMobile({});
// jQuery('.js-menu-smart').menuSmart();
// console.timeEnd('SmartMenu');


(function sliderHeader() {

    var sliderHeader = {

        carousel : jQuery(".js-slider-header.owl-carousel")

    };

    sliderHeader.carousel.owlCarousel({

        autoplay: true,

        autoplayTimeout: 6000,

        loop:true,

        margin:0,

        nav:true,

        dots: true,

        items: 1,

        animateOut: 'fadeOut',

        animateIn: 'fadeIn'

    });





}());


/*=========================================================================*/
/* Window Resize с mediaEventListener */
// навешиваем скрипты на разные разрешения
var plusCarousel =  jQuery('.js-plus-list').find('.plus__list');
mediaEventListener.addQueryAction('mobile', function(){
    if(!plusCarousel.hasClass('owl-carousel')){
        jQuery('.js-plus-list').find('.plus__list').addClass('owl-carousel');
        plusCarousel.owlCarousel({
            center: false,
            nav: true,
            dots: false,
            loop: true,
            margin: 20,
            items:3,
            responsive: {
                0: {
                    items:1
                },
                368: {
                    items:2
                },
                568: {
                    items:3
                }
            }
        });
    }

});
mediaEventListener.addQueryAction('desktop', function(){
    if(plusCarousel.hasClass('owl-carousel')){
        plusCarousel.trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
    }

});
mediaEventListener.addQueryAction('resize', function(){
    // console.log('resize');
});
// mediaEventListener.addQueryAction('resize', function(){
//     console.log('resize');
//

window.addEventListener('scroll', function() {

    if( app.helper.scroll.direction() === 'down'){
        jQuery('.header-mobile').addClass('-small');
    } else {
        jQuery('.header-mobile').removeClass('-small');
    }
});

(function () {
    jQuery('.header-mobile__switch-elements').on('click', function () {
        jQuery('.header-mobile__element').removeClass('is-active');
        jQuery('.header-mobile__toolbar-item').removeClass('is-active');
        jQuery('.header-mobile__switch-elements').removeClass('is-active');
    });
    jQuery('.header-mobile__toolbar-item').on('click', function () {
        var className = jQuery(this).data('class') ;

        if ( !jQuery('.header-mobile__element.' + className).hasClass('is-active') ){
            setTimeout(function () {
                jQuery('.header-mobile__element.' + className).addClass('is-active');
                jQuery('.header-mobile__switch-elements').addClass('is-active');
                jQuery('.header-mobile__toolbar-item[data-class="' + className + '"]').addClass('is-active');
            }, 300);
        }
        jQuery('.header-mobile__element').removeClass('is-active');
        jQuery('.header-mobile__switch-elements').removeClass('is-active');
        jQuery('.header-mobile__toolbar-item').removeClass('is-active');
    });
    //
    jQuery('.header-mobile__element.-menu').append( jQuery('.menu-top').clone() );
    jQuery('.header-mobile__element.-cart').append( jQuery('.header-top__cart').clone() );
    jQuery('.header-mobile__element.-search').append( jQuery('.form-search').clone() );
    jQuery('.header-mobile__element.-phone').append( jQuery('.header-top__left-block').clone() );
    //
    jQuery('.header-mobile__form').on('click', function () {
        event.stopPropagation();
    });
})();


jQuery('.js-print-page').on('click', function () {
    window.print();
});

/***************************************************************************/
/*********************       Scroll Top        *****************************/
/***************************************************************************/

jQuery(document).on('click', '.js-scroll-top', function () {
    jQuery("body:not(:animated)").animate({ scrollTop: 0 }, 500);
    jQuery("html").animate({ scrollTop: 0 }, 500);
    return false;
});

jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop()>105 && true ){
        jQuery(".js-scroll-top").css({"display":"block"});
    } else {
        jQuery(".js-scroll-top").css({"display":"none"});
    }
});
jQuery('.menu-left .has-dropdown > a').on('click', function () {
    var parent = jQuery(this).parent();
    var dropdown = jQuery(this).next();
    if(parent.hasClass('is-open')){
        dropdown.slideToggle();
        parent.removeClass('is-open');
    } else {
        dropdown.slideToggle();
        parent.addClass('is-open');
    }
    return false;
});

(function productsWidget() {
    jQuery(".js-product-carousel").each(function () {
        var productsWidget = {
            carousel : jQuery(this).find(".owl-carousel"),
            nextBtn : jQuery(this).find(".js-nav-next"),
            prevBtn : jQuery(this).find(".js-nav-prev")
        };
        productsWidget.carousel.owlCarousel({
            center: false,
            nav: false,
            dots: false,
            loop: true,
            autoWidth: true,
            margin: 20,
            items:3,
            responsive: {
                0: {
                    dots: false,
                    items:1,
                    margin: 15
                },
                480: {
                    dots: false,
                    margin: 20
                }
            }
        });
        productsWidget.nextBtn.click(function() {
            productsWidget.carousel.trigger('next.owl.carousel');
        });
        productsWidget.prevBtn.click(function() {
            productsWidget.carousel.trigger('prev.owl.carousel');
        });
    });

}());

// инициализирует везде кроме корзины
jQuery('input[type="number"]').not('.cart input[type="number"]').customNumber();

// инициализирует в корзине
jQuery('.cart input[type="number"]').customNumber();

// обновление при изменении
jQuery('.cart input[type="number"]').on('change', function(){
    document.updateCart.submit();
});



(function videosWidget() {
    jQuery(".js-homepage-bottom-videos").each(function () {
        var videosWidget = {
            carousel : jQuery(this).find(".owl-carousel")
        };
        videosWidget.carousel.owlCarousel({
            center: false,
            nav: false,
            dots: false,
            loop: false,
            autoWidth: false,
            margin: 20,
            items:3,
            responsive: {
                0: {
                    dots: true,
                    items:1
                },
                568: {
                    dots: true,
                    items:2
                }
                ,
                960: {
                    items:3
                }
            }
        });
    });

}());

(function productsImagesWidget() {
    jQuery(".js-product-images-carousel").each(function () {
        var productsImagesWidget = {
            carousel : jQuery(this).find(".owl-carousel"),
            items : jQuery(this).find('.image-prev__item'),
            nextBtn : jQuery(this).find(".js-nav-next"),
            prevBtn : jQuery(this).find(".js-nav-prev")
        };
        productsImagesWidget.carousel.owlCarousel({
            center: false,
            nav: false,
            dots: false,
            loop: true,
            autoWidth: false,
            margin: 10,
            items:3
        });
        productsImagesWidget.nextBtn.click(function() {
            productsImagesWidget.carousel.trigger('next.owl.carousel');
        });
        productsImagesWidget.prevBtn.click(function() {
            productsImagesWidget.carousel.trigger('prev.owl.carousel');
        });

        productsImagesWidget.items.on('click', function () {
            jQuery('.product-cart__image-big').find("img").attr('src', jQuery(this).attr("data-src-big"));
            productsImagesWidget.items.removeClass('is-active');
            jQuery(this).addClass('is-active');
        });
    });

}());

jQuery('.ordering__item').on('click', '.ordering__item-title', function () {
    var self = jQuery(this);
    var parent = self.parent();
    var content = parent.find('.ordering__item-content');
    if( self.hasClass('is-active')) {
        self.removeClass('is-active');
        content.hide();
    } else {
        self.addClass('is-active');
        content.show();
    }

});

jQuery('body').on('click', '.overlay__close', function () {
    jQuery('.overlay').remove();
});
jQuery('body').on('click', '.overlay__bg', function () {
    jQuery('.overlay').remove();
});


// init Masonry
var masonry = jQuery('.news-page').masonry({
    // set itemSelector so .grid-sizer is not used in layout
    itemSelector: '.news-page__item',
    // use element for option
    columnWidth: '.news-page__sizer',
    percentPosition: true,
    gutter: 10
});
// layout Masonry after each image loads
masonry.imagesLoaded().progress( function() {
    masonry.masonry('layout');
});

jQuery('.user-profile__btn-change').on('click', function () {
    var parent = jQuery(this).parents('.user-profile__item');
    parent.toggleClass('is-active');
    parent.find('.user-profile__item-form').toggleClass('is-active');
});
/*=========================================================================*/
// mediaEventListener инициализируем после всех добавлений,
// скрипты подвешеные позже не отработают при первой загрузке
mediaEventListener.init();
/*=========================================================================*/