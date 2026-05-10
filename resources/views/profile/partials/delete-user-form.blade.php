<section class="delete-card space-y-6">

    <header>
        <h2>Delete Account</h2>

        <p>
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please download anything you want to keep before proceeding.
        </p>
    </header>

    <button class="danger-btn"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-box">
            @csrf
            @method('delete')

            <h2>Are you sure you want to delete your account?</h2>

            <p>
                This action is permanent. Please enter your password to confirm deletion.
            </p>

            <div class="input-group">
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="Password"
                />

                <span class="error">
                    @error('password', 'userDeletion') {{ $message }} @enderror
                </span>
            </div>

            <div class="modal-actions">
                <button type="button"
                    class="secondary-btn"
                    x-on:click="$dispatch('close')">
                    Cancel
                </button>

                <button type="submit" class="danger-btn">
                    Delete Account
                </button>
            </div>
        </form>
    </x-modal>

</section>

<style>
.delete-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:14px;
    padding:20px;
}

.delete-card h2{
    font-size:18px;
    font-weight:800;
    color:#111827;
}

.delete-card p{
    font-size:13px;
    color:#6b7280;
    margin-top:6px;
    line-height:1.5;
}

/* BUTTONS */
.danger-btn{
    margin-top:12px;
    background:#dc2626;
    color:#fff;
    border:none;
    padding:10px 14px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

.secondary-btn{
    background:#e5e7eb;
    color:#111827;
    border:none;
    padding:10px 14px;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
}

/* MODAL */
.modal-box{
    background:#fff;
    padding:20px;
    border-radius:14px;
    width:420px;
}

.modal-box h2{
    font-size:16px;
    font-weight:800;
    color:#111827;
}

.modal-box p{
    font-size:13px;
    color:#6b7280;
    margin-top:8px;
}

/* INPUT */
.input-group{
    margin-top:14px;
}

.input-group input{
    width:100%;
    padding:10px 12px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    font-size:13px;
    outline:none;
}

.input-group input:focus{
    border-color:#111827;
}

/* ERROR */
.error{
    font-size:12px;
    color:#dc2626;
}

/* MODAL ACTIONS */
.modal-actions{
    display:flex;
    justify-content:flex-end;
    gap:10px;
    margin-top:16px;
}
</style>