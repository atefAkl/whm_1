<section class="space-y-6">
    <form method="POST" action="{{ route('profile.destroy', $user) }}">
        @csrf
        @method('DELETE')

        <div class="form-group">
            <label for="confirm">هل أنت متأكد أنك تريد حذف حسابك؟</label>
            <input type="checkbox" id="confirm" name="confirm" required>
            <span>نعم، أنا متأكد.</span>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-danger">حذف الحساب</button>
        </div>
    </form>
</section>