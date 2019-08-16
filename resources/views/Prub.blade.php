<div class="row">
    <div id="edit_inicio" class="form-group col-md-6 pl-1">
        <label for="edit_inicio" class="control-label">Fecha edit_inicio:</label>
        <input type="date" class="form-control" id="edit_inicio" name="edit_inicio"
               value="{{ old('edit_inicio') }}" required>
    </div>
    <div id="edit_fin" class="form-group col-md-6 pl-1">
        <label for="edit_fin" class="control-label">Fecha edit_fin:</label>
        <input type="date" class="form-control" id="edit_fin" name="edit_fin" value="{{ old('edit_fin') }}"
               required>
    </div>
</div>
