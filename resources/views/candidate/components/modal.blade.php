    <!-- Add Candidate Modal -->
    <div class="modal fade" id="addCandidateModal" tabindex="-1" aria-labelledby="addCandidateModalLabel" aria-hidden="true"
        data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="addCandidateModalLabel">Add Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('candidate.store') }}" method="post" id="addCandidateForm"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture" accept="image/*"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="resume">Resume</label>
                            <input type="file" class="form-control" id="resume" name="resume"
                                accept="application/pdf" required>
                        </div>
                        <div class="form-group">
                            <label for="election_number">Election Number</label>
                            <input type="number" class="form-control" id="election_number" name="election_number"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="createBtn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Candidate Modal -->
    <div class="modal fade" id="editCandidateModal" tabindex="-1" aria-labelledby="editCandidateModalLabel"
        aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editCandidateModalLabel">Edit Candidate</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editCandidateForm" method="post"
                    action="{{ route('candidate.update', ['candidate' => 0]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="editName">Name</label>
                            <input type="text" class="form-control" id="editName" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="editPicture">Picture</label>
                            <input type="file" class="form-control" id="editPicture" name="picture" accept="image/*">
                            <img id="editPicturePreview" class="img-thumbnail">
                        </div>
                        <div class="form-group">
                            <label for="editResume">Resume</label>
                            <input type="file" class="form-control" id="editResume" name="resume"
                                accept="application/pdf">
                            <a id="editResumePreview" class="d-block mt-1" target="_blank"></a>
                        </div>
                        <div class="form-group">
                            <label for="editElectionNumber">Election Number</label>
                            <input type="number" class="form-control" id="editElectionNumber"
                                name="election_number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#editCandidateModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var name = button.data('name');
                var electionNumber = button.data('election_number');
                var picture = button.data('picture');
                var resume = button.data('resume');

                $('#editName').val(name);
                $('#editElectionNumber').val(electionNumber);
                $('#editId').val(id);
                $('#editPicturePreview').attr('src', '/storage/' + picture);

                if (resume) {
                    $('#editResumePreview')
                        .attr('href', '/storage/' + resume)
                        .attr('title', resume)
                        .html('<small>View current resume' + '</small>')
                        .show();
                } else {
                    $('#editResumePreview').hide();
                }

                $('#editCandidateForm').attr('action', '/candidate/' + id).attr('enctype',
                    'multipart/form-data');
            });
        });
    </script>
