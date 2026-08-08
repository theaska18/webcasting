<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo1.png">
        <title>Template | Webcasting</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <style>
        body{
            font-family:Inter,sans-serif;
        }
        </style>
    </head>
    <body class="min-h-screen flex flex-col bg-slate-50 bg-gradient-to-b from-white via-blue-100 to-white">
        <?php
            if(isset($navigate)==null){
                $this->load->view('layouts/navigates/main');
            }else{
                $this->load->view('layouts/$navigate');
            }
        ?>
        <main class="flex-1 ">
            <!-- HERO -->
            <section class="bg-slate-50">
                <?php
                    if(isset($view)){
                        $this->load->view($view);
                    }else{
                        echo 'Paramaeter View Not Found.';
                    }
                ?>
            </section>

        </main>
        <?php $this->load->view('layouts/footer'); ?>
    </body>
</html>