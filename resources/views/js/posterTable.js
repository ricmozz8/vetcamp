document.addEventListener('DOMContentLoaded', function () {

    let order_arrow = document.getElementById('sort-icon-documents');
    let order_th = document.getElementById('order-doc');


    if (order_arrow) setMyIcon(order_arrow, 'doc');
    if (order_th) order_th.setAttribute('order', getOrder('doc'));

    order_th = document.getElementById('order-date');
    if (order_th) order_th.setAttribute('order', getOrder('date'));
    let date_order_arrow = document.getElementById('sort-icon-date');
    if (date_order_arrow) setMyIcon(date_order_arrow, 'date');

});

function toggleDocumentOrder(clicked) {

    let order_arrow = document.getElementById('sort-icon-documents');
    let queryOrder = toggleTableOrder(clicked, order_arrow);

    let currentUrl = new URL(window.location.href);

    currentUrl.searchParams.set('doc', queryOrder);
    window.location.search = currentUrl.search;

}

function toggleDateOrder(clicked) {

    let order_arrow = document.getElementById('sort-icon-date');
    let queryOrder = toggleTableOrder(clicked, order_arrow);

    let currentUrl = new URL(window.location.href);

    currentUrl.searchParams.set('date', queryOrder);
    window.location.search = currentUrl.search;

}

function getArrow(filter) {

    let params = new URLSearchParams(window.location.search);
    let order = params.get(filter);

    let icon_class_name = 'las la-sort-down';

    if (order) {
        switch (order) {
            case 'asc':
                icon_class_name = 'las la-sort-up';
                break;
            case 'desc':
                icon_class_name = 'las la-sort-down';
                break;
        }
    }

    return icon_class_name;
}

function getOrder(filter) {
    let params = new URLSearchParams(window.location.search);
    let order = params.get(filter);
    switch (order) {
        case 'asc':
            return 'up';
            break;
        case 'desc':
            return 'down';
            break;
        default:
            return 'down';
            break;
    }
}

function setMyIcon(icon, filter) {

    icon.className = getArrow(filter); // Reset the class name

}

function toggleTableOrder(clicked, icon) {

    let query_order = 'desc';
    let order = clicked.getAttribute('order') || 'down';

    if (order === 'down') {
        query_order = 'asc';
        clicked.setAttribute('order', 'up');
        icon.className = 'las la-sort-up';
    } else if (order === 'up') {
        query_order = 'desc';
        clicked.setAttribute('order', 'down');
        icon.className = 'las la-sort-down';
    }

    return query_order;

}