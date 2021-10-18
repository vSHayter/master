<?php

use yii\helpers\Url;

?>

<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="exceptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Oops</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sign in to do this.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= Url::to(['auth/login']) ?>" role="button">Ok</a>
            </div>
        </div>
    </div>
</div>
