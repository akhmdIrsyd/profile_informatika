<!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Item Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itemForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="itemId" name="itemId">
                    <div class="form-group">
                        <label for="tahun">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun">
                    </div>
                    <div class="form-group">
                        <label for="jml_peminat">Jumlah Peminat</label>
                        <input type="number" class="form-control" id="jml_peminat" name="jml_peminat">
                    </div>
                    <div class="form-group">
                        <label for="juml_masuk">Jumlah Masuk</label>
                        <input type="number" class="form-control" id="juml_masuk" name="juml_masuk">
                    </div>
                    <div class="form-group">
                        <label for="juml_lulus">Jumlah Lulus</label>
                        <input type="number" class="form-control" id="juml_lulus" name="juml_lulus">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveItem">Save changes</button>
            </div>
        </div>
    </div>
</div>