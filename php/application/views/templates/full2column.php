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
    <body class="h-screen flex flex-col overflow-hidden bg-slate-100">
        <?php
            if(isset($navigate)==null){
                $this->load->view('layouts/navigates/main');
            }else{
                $this->load->view('layouts/navigates/'.$navigate);
            }
        ?>
        <div class="flex-1 flex">

            <!-- Sidebar -->
            <aside class="w-72 bg-slate-900 text-white flex-shrink-0">
                <?php
                    if(isset($left)){
                        $this->load->view($left);
                    }
                ?>

                

            </aside>

            <!-- Right -->
            <div class="flex-1 flex flex-col overflow-hidden">

                <!-- Content -->
                <main class="flex-1 overflow-y-auto bg-slate-100">

                        <?php
                        if(isset($view)){
                            $this->load->view($view);
                        }else{
                            echo 'Parameter View Not Found.';
                        }
                        ?>


                </main>

            </div>

        </div>
    </body>
</html>