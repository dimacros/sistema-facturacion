//Initialize components
$('#customer_id').selectize({
    valueField: 'id',
    labelField: 'company_name',
    placeholder: 'Seleccione una opción',
    searchField: ['document_value', 'company_name'],
    load: function(query, callback) {
        
        if( query.length < 3 ) { return callback(); }

        const customers_url = this.$input.data('url');
        axios({
            method: "GET",
            params: { search: query },
            url: customers_url
        })
        .then(function (response) {
            callback(response.data.rows);
        })
        .catch(function (error) {
            callback(error);
        });
    }
});

$('#product_id').selectize({
    valueField: 'id',
    labelField: 'description',
    placeholder: 'Descripción del Producto',
    searchField: ['code', 'description'],
    load: function(query, callback) {

        if( query.length < 3 ) { return callback(); }

        const products_url = this.$input.data('url');
        axios({
            method: "GET",
            params: { search: query },
            url: products_url
        })
        .then(function (response) {
            callback(response.data.rows);
        })
        .catch(function (error) {
            callback(error);
        });
    },
    onChange: function(value){

        if( value.length ) {
            var product = this.options[value];
            document.getElementById('product_code').value = product.code;
            document.getElementById('product_description').value = product.description;
            document.getElementById('product_price').value = product.price;
        }
        else {
            document.getElementById('add-item').reset();
        }
    }
});

$('#items').bootstrapTable({
    columns: [
        { field: 'id', visible: false }, 
        { field: 'code', title: 'Código' }, 
        { field: 'description', title: 'Descripción' }, 
        { field: 'quantity', title: 'Cantidad', align: 'center' }, 
        { field: 'price', title: 'Precio unitario' } , 
        { field: 'subtotal', title: 'Subtotal' }
    ],
    uniqueId: 'id'
});

//Submit Events
var items = $('#items'); var order = 0;
document.getElementById('add-item').addEventListener('submit', function(e){

    e.preventDefault();
    var data = serialize(this, {hash: true});

    if( items.bootstrapTable('getRowByUniqueId', data.product_id) ) {

        items.bootstrapTable('updateByUniqueId', {
            id: data.product_id,
            row: {
                quantity: data.quantity, 
                price: data.product_price.toFixed(2),
                subtotal:  (data.quantity * data.product_price).toFixed(2)
            }
        });

    }
    else {
        items.bootstrapTable('insertRow', {
            index: order,
            row: {
                id: data.product_id,
                code: data.product_code,
                description: data.product_description,
                quantity: data.quantity, 
                price: data.product_price,
                subtotal:  (data.quantity * data.product_price).toFixed(2)
            }
        });
        order++;
    }

    var subtotalVentas = 0, invoiceItems = items.bootstrapTable('getData');
    for (let i = 0; i < invoiceItems.length; i++) {
        subtotalVentas += parseFloat(invoiceItems[i].subtotal);
    }
    var igv = (subtotalVentas * 0.18).toFixed(2);
    document.getElementById('subtotalVentas').value = subtotalVentas.toFixed(2);
    document.getElementById('igv').value = igv;
    document.getElementById('importeTotal').value = (subtotalVentas + parseFloat(igv)).toFixed(2);
});

document.getElementById('add-invoice').addEventListener('submit', function(e){
    e.preventDefault();
    document.getElementById('btn-add-invoice').disabled = true;
    var invoiceItemsElement = this.querySelector('#invoice-items');
    while (invoiceItemsElement.firstChild) {
        invoiceItemsElement.removeChild(invoiceItemsElement.firstChild);
    }
    var invoiceItems = items.bootstrapTable('getData');
    for (let i = 0; i < invoiceItems.length; i++) {
        const item = invoiceItems[i];
        $(invoiceItemsElement).append([
            `<input type="hidden" name="items[${i}][product_id]" value="${item.id}"/>`,
            `<input type="hidden" name="items[${i}][code]" value="${item.code}"/>`,
            `<input type="hidden" name="items[${i}][description]" value="${item.description}"/>`,
            `<input type="hidden" name="items[${i}][quantity]" value="${item.quantity}"/>`,
            `<input type="hidden" name="items[${i}][price]" value="${item.price}"/>`,
            `<input type="hidden" name="items[${i}][subtotal]" value="${item.subtotal}"/>`,
        ]);
    }
    var invoiceData = serialize(this);
    axios.post(this.action, invoiceData)
    .then(function(response){
        console.log(response.data);
    })
    .catch(function (error) {
        var listErrors = error.response.data.errors;
        var countErrors = 0;
        var list = document.createElement('ul');
        for (let errorName in listErrors) {
            const description = listErrors[errorName][0];
            const listItem = document.createElement('li');
            listItem.innerText = description;
            list.appendChild(listItem);
            countErrors++;
        }
        var title = `¡Hay ${countErrors} ${(countErrors === 1) ? 'error' : 'errores'} en el formulario!`;
        toastr.error(list, title, {
            positionClass: "toast-bottom-right",
            progressBar: true,
            timeOut: 6000
        });
        document.getElementById('btn-add-invoice').disabled = false;
    })
    
});