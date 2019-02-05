<fieldset class="border p-2">
    <legend class="w-auto">Detalles de Factura</legend>
    <form id="add-item">
        <div class="form-row align-items-center">
            <div class="col-lg-3 mb-2">
                <select name="product_id" id="product_id" style="display:none;"
                    data-url="{{ route('admin.products.data') }}" required>
                </select>
                <input type="hidden" name="product_code" id="product_code"/>
                <input type="hidden" name="product_description" id="product_description"/>
            </div>
            <div class="col-lg-1 mb-2">
                <input type="number" name="quantity" class="form-control" required/>
            </div>
            <div class="col-lg-2 mb-2">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">S/.</div>
                    </div>
                    <input type="number" name="product_price" id="product_price" class="form-control" step="0.01" required/>
                </div>
            </div>
            <div class="col-auto mb-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Agregar
                </button>
            </div>
        </div>
    </form>
    <table id="items"></table>
    <div class="row">
        <div class="col-lg-6 offset-lg-6">
            <fieldset class="border p-2">
                <legend class="w-auto">Resumen</legend>
                <div class="form-row mb-2">
                    <label class="col-3 text-right col-form-label">
                        Subtotal Ventas:
                    </label>
                    <div class="col-9">
                      <input type="number" id="subtotalVentas" class="form-control" value="0.00" readonly/>
                    </div>
                </div>
                <div class="form-row mb-2">
                    <label class="col-3 text-right col-form-label">
                        IGV:
                    </label>
                    <div class="col-9">
                      <input type="number" id="igv" class="form-control" value="0.00" readonly/>
                    </div>
                </div>
                <div class="form-row mb-2">
                    <label class="col-3 text-right col-form-label">
                        Importe Total:
                    </label>
                    <div class="col-9">
                      <input type="number" id="importeTotal" class="form-control" value="0.00" readonly/>
                    </div>
                </div>
            </fieldset>                    
        </div>
    </div>
</fieldset>