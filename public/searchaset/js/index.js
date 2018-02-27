$('.search-button').click(function(){
  showResult();
});

$('.search-data').keydown(function(){
  alert('asd');
  if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
        showResult();
    }
});