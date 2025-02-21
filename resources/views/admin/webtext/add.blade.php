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
                    <input type="hidden" id="nama" name="nama">
                    <div class="form-group">
                        <label for="isi">Isi</label>
                        <input type="text" class="form-control" id="isi" name="isi">
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