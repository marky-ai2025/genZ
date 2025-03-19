<div class="modal fade" id="addSchoolModal" tabindex="-1" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="addSchoolModalLabel">Add School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Loading Screen -->
                <div id="loadingOverlay" class="loading-overlay d-none">
                    <div class="loading-spinner">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <p>Saving school data...</p>
                </div>

                <form id="addSchoolForm" action="{{ route('school.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="schoolName" class="form-label">Name of School</label>
                            <input type="text" class="form-control" id="schoolName" name="name" placeholder="Blank University" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="schoolAbbr" class="form-label">School (Abbreviation)</label>
                            <input type="text" class="form-control" id="schoolAbbr" name="abbr" placeholder="NC" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="schoolbrgy" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="schoolbrgy" name="brgy" placeholder="Di mahanap" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="citymun" class="form-label">City/Municipality</label>
                            <input type="text" class="form-control" id="citymun" name="city" placeholder="Santiago City" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="prov" class="form-label">Province</label>
                            <input type="text" class="form-control" id="prov" name="prov" placeholder="Isabela" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contactnumber" class="form-label">Contact Number</label>
                            <input type="text" class="form-control" id="contactnumber" name="contact" placeholder="(078) xxx xxxx" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="schooltype" class="form-label">Type of School</label>
                            <select class="form-select" id="schooltype" name="type" required>
                                <option value="">Select</option>
                                <option value="Private">Private</option>
                                <option value="Public">Public</option>
                                <option value="University">University</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-primary">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x"></i> Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Full-screen loading overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 1050;
        text-align: center;
        font-weight: bold;
        font-size: 1.2rem;
        color: #007bff;
    }

    /* Animated spinner */
    .loading-spinner {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .loading-spinner div {
        position: absolute;
        width: 16px;
        height: 16px;
        background: #007bff;
        border-radius: 50%;
        animation: loadingAnim 1.2s linear infinite;
    }

    .loading-spinner div:nth-child(1) {
        top: 8px;
        left: 8px;
        animation-delay: -0.3s;
    }
    .loading-spinner div:nth-child(2) {
        top: 8px;
        right: 8px;
        animation-delay: -0.15s;
    }
    .loading-spinner div:nth-child(3) {
        bottom: 8px;
        left: 8px;
        animation-delay: 0s;
    }
    .loading-spinner div:nth-child(4) {
        bottom: 8px;
        right: 8px;
        animation-delay: 0.15s;
    }

    @keyframes loadingAnim {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("addSchoolForm");
        const loadingOverlay = document.getElementById("loadingOverlay");

        form.addEventListener("submit", function () {
            // Show the animated loading overlay
            loadingOverlay.classList.remove("d-none");
        });
    });
</script>