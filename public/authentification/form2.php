

<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="name">Votre pseudo</label>
                <input id="name" type="text" class="form-control" name="pseudo" value="<?= isset ($data['pseudo']) ? h($data['pseudo']) : ''; ?>" required>
                <?php if (isset($errors['pseudo'])): ?>
                    <small class="help-text text-muted"><?= $errors['pseudo']; ?></small>
                    <?php endif; ?>
            </div>
        </div>
</div>

<div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="mdp">Mot de passe </label>
                <input id="mdp" type="Password" class="form-control" name="mdp" value="<?= isset ($data['mdp']) ? h($data['mdp']) : ''; ?>" required>
                <?php if (isset($errors['name'])): ?>
                    <small class="help-text text-muted"><?= $errors['name']; ?></small>
                    <?php endif; ?>
            </div>      
        </div>
</div>        
