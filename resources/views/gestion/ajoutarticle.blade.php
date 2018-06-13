@extends('layouts.mainlayout')
@section('title', "ajoutarticle")
@section('contenu')

<main class="container">
	<section id="article" class="container pb-4">
    <main class="row pt-3">
        <div class="col-12">
            <h2>Ajout d'un produit</h2>
            <hr>
        </div>
        

        <section class="col-12">
            <form method="POST"  enctype="multipart/form-data">
                
                <div class="form-group row">
                    <div class="col-12">
                        <h3>Description du prduit</h3>
                    </div>
                    <label for="name" class="col-md-3 col-form-label text-md-right">Titre</label>
                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control" name="titre" required autofocus placeholder="Taper votre titre">
                       
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-3 col-form-label text-md-right">Description</label>
                    <div class="col-md-8">
                        <textarea id="texte" class="form-control" name="contenuearticle" required></textarea>
                        <script>
                            CKEDITOR.replace('texte');
                        </script>
                    
                    </div>
                </div>
                   <h3>Prix</h3>
                    </div>
                    <label for="prix" class="col-md-3 col-form-label text-md-right">Prix</label>
                    <div class="col-md-8">
                        <input id="prix" type="text" class="form-control" name="prix" required autofocus placeholder="Renseigner le prix du produit">
                       
                    </div>
                <div class="form-group row">
                    <div class="col-12">
                        <h3>Catégorie du produit</h3>
                       
                       <div class="form-check">
                         <div class="form-group">
                         <label for="exampleFormControlSelect1">Catégories</label>
                            <select class="form-control" id="exampleFormControlSelect1">
                             <option>Bijouterie</option>
                             <option>Vestimentaire</option>
                             <option>Alimentaire</option>
                            <option></option>
      
                         </select>
                        </div>

                        </div>
                    </div>
                    <div class="form-group row">
                       <p></p>
                    </div>
                </div>
              
                   <div class="form-group row justify-content-center">
                        <div class="col-12">

                         
                            <h3>Images</h3>
                            
                            <a href="#"></a>

                        </div>
                        <div class="col-11 py-4">
                            <label for="image">Choisir un fichier</label>
                            <input type="file" class="form-control" name="image" id="image" value="">
                           
                        </div>
                    </div><!-- /.row -->
                <div class="form-group row pb-3">
                    <div class="col-md-6 offset-md-3">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
                </form>
        </section>
    </main>
</section>

</main>

@endsection