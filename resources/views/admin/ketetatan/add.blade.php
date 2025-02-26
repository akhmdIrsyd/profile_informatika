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
                        <label for="jml_snmptn">Peminat SNMPTN</label>
                        <input type="number" class="form-control" id="jml_snmptn" name="jml_snmptn">
                    </div>
                    <div class="form-group">
                        <label for="kuota_snmptn">Kuota SNMPTN</label>
                        <input type="number" class="form-control" id="kuota_snmptn" name="kuota_snmptn">
                    </div>

                    <div class="form-group">
                        <label for="jml_sbnptn">Peminat SBMPTN</label>
                        <input type="number" class="form-control" id="jml_sbnptn" name="jml_sbnptn">
                    </div>
                    <div class="form-group">
                        <label for="kuota_sbnptn">Kuota SBMPTN</label>
                        <input type="number" class="form-control" id="kuota_sbnptn" name="kuota_sbnptn">
                    </div>
                    <div class="form-group">
                        <label for="jml_mandiri">Peminat Mandiri</label>
                        <input type="number" class="form-control" id="jml_mandiri" name="jml_mandiri">
                    </div>
                    <div class="form-group">
                        <label for="kuota_mandiri">Kuota Mandiri</label>
                        <input type="number" class="form-control" id="kuota_mandiri" name="kuota_mandiri">
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