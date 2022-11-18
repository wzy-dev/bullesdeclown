function initArticleBlock(url) {
  $('.link--articleBlock').click(function(e){
  	showLoader();
    $.ajax(url+$(this).data('article'))
    .done(function(data) {
        	data=JSON.parse(data);
          if (data.article.helloAsso === null) {
            var popup=$('<div class="shadow p-4 rounded align-self-center article-box" style="background:rgba(255,255,255);width:90%;height:90%"><div class="d-flex flex-column w-100 h-100"><h3>'+data.article.title+'</h3><hr class="w-100"/><div class="mb-1" style="max-height:68.5vh;height:100%;overflow-y:auto">'+data.article.content+'</div></div><i>Publié le '+data.date+' dans '+data.category+'</i><div style="bottom: 7vh;left:7.3vw;position: absolute;"><button type="button" class="closePopup btn btn-link p-0 font-weight-bold">Fermer l\'actualité</button></div>');
        	} else {
            var popup=$('<div class="shadow p-4 rounded align-self-center article-box" style="background:rgba(255,255,255);width:90%;height:90%"><div class="d-flex flex-column w-100 h-100"><h3>'+data.article.title+'</h3><hr class="w-100"/><div class="mb-1" style="max-height:68.5vh;height:100%;overflow-y:auto">'+data.article.content+'<iframe id="haWidget" allowtransparency="true" scrolling="auto" src="'+data.article.helloAsso+'/widget" style="width:100%;height:750px;border:none;padding:5px" onload="window.scroll(0, this.offsetTop)"></iframe></div></div><i>Publié le '+data.date+' dans '+data.category+'</i><div style="bottom: 7vh;left:7.3vw;position: absolute;"><button type="button" class="closePopup btn btn-link p-0 font-weight-bold">Fermer l\'actualité</button></div>');
          }
            $('.popup').append(popup);
        		$('.loader').hide();
        	$('.closePopup').click(function(){
            $('.popup div').remove();          
          	hideLoader();
        	});
    })
    .fail(function() {
        hideLoader();
    });     
  });
}