<!DOCTYPE html>
<html lang="en">

<!-- head -->
<?php
include "inc/head.inc.php";
?>

<body class="text-light">

    <!-- loader -->
    <?php
    include "inc/loader.inc.php";
    ?>

    <!-- nav -->
    <?php
    include "inc/nav.inc.php";
    ?>

    <main>
        <!-- search/filter section -->
        <section class="py-4 bg-secondary">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <form class="d-flex flex-column flex-lg-row align-items-center gap-3" method="get">
                            <input type="text" name="search" class="form-control" placeholder="Search for card name..." aria-label="Card name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                            <div class="d-flex flex-column flex-lg-row gap-3">
                                <?php
                                $qualities = ['common', 'rare', 'epic', 'legendary'];
                                $selected_qualities = isset($_GET['quality']) ? $_GET['quality'] : $qualities;
                                foreach ($qualities as $q) {
                                    $checked = in_array($q, $selected_qualities) ? 'checked' : '';
                                    $label = ucfirst($q);
                                    echo "<div class='form-check'>
                                        <input class='form-check-input' type='checkbox' name='quality[]' id='$q' value='$q' $checked>
                                        <label class='form-check-label' for='$q'>
                                            $label
                                        </label>
                                    </div>";
                                }
                                ?>
                            </div>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- shop cards section -->
        <section class="py-5">
            <div class="container">
                <div class="row g-4" style="overflow-y: auto; max-height: 70vh;">
                
                <?php
                
                $card = [
                    ['id' => 1, 'name' => 'common card 1', 'quality' => 'Common', 'image' => 'images/logo.webp'],
                    ['id' => 2, 'name' => 'common card 2', 'quality' => 'Common', 'image' => 'images/logo.webp'],
                    ['id' => 3, 'name' => 'rare card 1', 'quality' => 'Rare', 'image' => 'images/logo.webp'],
                    ['id' => 4, 'name' => 'rare card 2', 'quality' => 'Rare', 'image' => 'images/logo.webp'],
                    ['id' => 5, 'name' => 'epic card 1', 'quality' => 'Epic', 'image' => 'images/logo.webp'],
                    ['id' => 6, 'name' => 'epic card 1', 'quality' => 'Epic', 'image' => 'images/logo.webp'],
                    ['id' => 7, 'name' => 'legendary card 1', 'quality' => 'Legendary', 'image' => 'images/logo.webp'],
                    ['id' => 8, 'name' => 'legendary card 2', 'quality' => 'Legendary', 'image' => 'images/logo.webp']
                ];

                // Backend function to filter cards
                function filter_cards($cards, $search_term, $quality_filters) {
                    $filtered = $cards;
                    
                    // Filter by search term (card name)
                    if (!empty($search_term)) {
                        $filtered = array_filter($filtered, function($c) use ($search_term) {
                            return stripos($c['name'], $search_term) !== false;
                        });
                    }
                    
                    // Filter by qualities
                    if (!empty($quality_filters)) {
                        $filtered = array_filter($filtered, function($c) use ($quality_filters) {
                            return in_array(strtolower($c['quality']), array_map('strtolower', $quality_filters));
                        });
                    }
                    
                    return $filtered;
                }

                // Get search parameters
                $search_term = isset($_GET['search']) ? trim($_GET['search']) : '';
                $qualities = ['common', 'rare', 'epic', 'legendary'];
                $quality_filters = isset($_GET['quality']) ? $_GET['quality'] : $qualities;

                // Filter the cards
                $filtered_cards = filter_cards($card, $search_term, $quality_filters);
                
                foreach($filtered_cards as $c) { ?>
                    <div class="col-md-4">
                        <div class="card bg-dark text-light h-100">
                            <img src="<?php echo $c["image"]; ?>" class="card-img-top" alt="Card Image" style="height: 200px; object-fit: contain;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo $c["name"]; ?></h5>
                                <p class="card-text">Quality: <?php echo $c["quality"]; ?></p>
                                <div class="mt-auto d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-outline-light btn-sm" onclick="decrement(<?php echo $c['id']; ?>)">-</button>
                                        <span id="quantity<?php echo $c['id']; ?>" class="mx-2 text-light">1</span>
                                        <button class="btn btn-outline-light btn-sm" onclick="increment(<?php echo $c['id']; ?>)">+</button>
                                    </div>
                                    <button class="btn btn-success">Buy</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section>
    </main>

</body>

</html>