$('.table-container').on('mousewheel DOMMouseScroll', function (e) {    
    var delta = e.originalEvent.wheelDelta || -e.originalEvent.detail;
    this.scrollLeft += (delta < 0 ? 1 : -1) * 30;
    e.preventDefault();
});
