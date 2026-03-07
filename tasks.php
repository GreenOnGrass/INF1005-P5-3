<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.inc.php'; ?>

<body>
    <?php include 'inc/nav.inc.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4" style="color: white;">Daily Tasks</h1>
        <p class="text-center mb-5" style="color: white;">Complete these daily tasks to earn in-game points!</p>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Log in to the website</h5>
                            <p class="mb-1">Sign in to your account today.</p>
                            <small class="text-muted">+10 points</small>
                        </div>
                        <button class="btn btn-success">Complete</button>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Visit the shop</h5>
                            <p class="mb-1">Browse the point shop for rewards.</p>
                            <small class="text-muted">+15 points</small>
                        </div>
                        <button class="btn btn-success">Complete</button>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Share on Twitter</h5>
                            <p class="mb-1">Spread the word about MintMint!</p>
                            <a href="https://twitter.com/intent/tweet?text=Check%20out%20MintMint%20Gacha!"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary mb-2"
                                onclick="markAsShared()">
                                Click to Share
                            </a>
                            <br>
                            <small class="text-muted">+20 points</small>
                        </div>
                        <button id="btn-share-claim" class="btn btn-success" disabled onclick="claimTask('share_social')">
                            Complete
                        </button>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Play a game</h5>
                            <p class="mb-1">Complete a mini-game on the site.</p>
                            <small class="text-muted">+25 points</small>
                        </div>
                        <button class="btn btn-success">Complete</button>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1">Invite a friend</h5>
                            <p class="mb-1">Invite a friend to join the website.</p>
                            <small class="text-muted">+30 points</small>
                        </div>
                        <button class="btn btn-success">Complete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>