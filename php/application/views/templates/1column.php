<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/images/logo1.png">
        <title>Template | Webcasting</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script type="text/javascript" src="<?= base_url(); ?>assets/jquery-4.0.0.min.js"></script>
        <script>
            $(function(){});
        </script>
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
            <section>
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