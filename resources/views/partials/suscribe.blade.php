<!-- Subscribe Start -->
    <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Sugerencias</span></h2>
                </div>
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="comment" style="text-align: center"><h5>Dinos lo que piensas:</h5></label>
                        <textarea style="color: black" class="form-control" name="comment" id="comment" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar comentario</button>
                </form>
            </div>
        </div>
    </div>
