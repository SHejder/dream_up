
(function($){
    var SF2 = window.SF2;
    var SF2Window = window.SF2Window;
    
    function highlightTab(){
        if(getCookie('sf2-records')=='checked'){
            return false;
        }
        var _tab = $('a[href="#attrib-records"]');
        _tab.addClass('sf2-db-records-tab').append('<i class="sf2-badge">NEW</i>');
        _tab.on('click',function(){
            setCookie('sf2-records','checked',365);
            _tab.find('.sf2-badge').remove();
        });
    }
    
    function setCookie(name,value,days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
    
    $(document).ready(function(){
        window.setTimeout(highlightTab,200);
        
        $('a.sf2-record-view-link').on('click',function(){
            var _link = $(this);
            var lid = SF2.showLoading(_link.closest('tr'));
            var cfg = new SF2.Config('records');
            
            $.ajax({
                'url': _link.attr('href'),
                'dataType': 'json',
                'success': function(responce,textStatus,jqXHR,$form){
                    SF2.hideLoading(lid);
                    if(responce.status=='success'){
                        SF2.showSuccess(responce.html);
                    }
                    else if(responce.status=='error'){
                        SF2.showError(responce.message);
                    }
                    else{
                        SF2.showError('AJAX server error.');
                    }
                },
                'error': function(jqXHR, textStatus, errorThrown){
                    SF2.hideLoading(lid);
                    SF2.showError(errorThrown);
                }
            });
            return false;
        });
        
        $('a.sf2-record-del-link').on('click',function(){
            var _link = $(this);
            var row = _link.closest('tr');
            var lid = SF2.showLoading(row);
            var cfg = new SF2.Config('records');
            if(!window.confirm(SF2.Text('sure-to-delete-record'))){
                SF2.hideLoading(lid);
                return false;
            }
            $.ajax({
                'url': _link.attr('href'),
                'dataType': 'json',
                'success': function(responce,textStatus,jqXHR,$form){
                    SF2.hideLoading(lid);
                    if(responce.status=='success'){
                        row.animate({
                            'opacity': 0
                        },300,'swing',function(){row.remove()});
                    }
                    else if(responce.status=='error'){
                        SF2.showError(responce.message);
                    }
                    else{
                        SF2.showError('AJAX server error.');
                    }
                },
                'error': function(jqXHR, textStatus, errorThrown){
                    SF2.hideLoading(lid);
                    SF2.showError(errorThrown);
                }
            });
            return false;
        });
        
    });
    
})(jQuery);