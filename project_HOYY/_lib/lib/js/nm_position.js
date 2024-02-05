function sc_position(anchor, content)
{
    sc_doHorizontalPosition(anchor, content);
    sc_doVerticalPosition(anchor, content);
    content.show();
}
function sc_positionHorizontal(anchor, content)
{
    sc_doHorizontalPosition(anchor, content);
    content.show();
}
function sc_positionVertical(anchor, content)
{
    sc_doVerticalPosition(anchor, content);
    content.show();
}
function sc_doHorizontalPosition(anchor, content)
{
    let windowWidth = $(window).width();
    let anchorLeftRelative = anchor.offset().left - $(window).scrollLeft();
    let anchorRightRelative = anchorLeftRelative + anchor.outerWidth();
    let anchorLeftAbsolute = anchor.offset().left;
    let anchorRightAbsolute = anchorLeftAbsolute + anchor.outerWidth();
    let contentWidth = content.outerWidth();
    if (anchorLeftRelative + contentWidth > windowWidth) {
        content.css('left', (anchorRightAbsolute - contentWidth) + 'px');
    } else {
        content.css('left', anchorLeftAbsolute + 'px');
    }
}
function sc_doVerticalPosition(anchor, content)
{
    let windowHeight = $(window).height();
    let anchorTopRelative = anchor.offset().top - $(window).scrollTop();
    let anchorBottomRelative = anchorTopRelative + anchor.outerHeight();
    let anchorTopAbsolute = anchor.offset().top;
    let anchorBottomAbsolute = anchorTopAbsolute + anchor.outerHeight();
    let contentHeight = content.outerHeight();
    if (anchorBottomRelative + contentHeight > windowHeight) {
        content.css('top', (anchorTopAbsolute - contentHeight) + 'px');
    } else {
        content.css('top', anchorBottomAbsolute + 'px');
    }
}

function scrollToElement(el)
{
    $([document.documentElement, document.body]).animate({
        scrollTop: $(el).offset().top - 100
    }, 200);
}

