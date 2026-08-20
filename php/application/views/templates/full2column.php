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
		<script type="text/javascript" src="<?= base_url(); ?>assets/jquery-4.0.0.min.js"></script>
    </head>
    <body class="h-screen flex flex-col bg-slate-100">
        <?php
            $this->load->view('layouts/common');
            if(isset($navigate)==null){
                $this->load->view('layouts/navigates/main');
            }else{
                $this->load->view('layouts/navigates/'.$navigate);
            }
        ?>
        <div class="flex h-screen overflow-hidden">
            <!-- Sidebar -->
            <aside id="sidebar" class="fixed md:static z-40 inset-y-0 left-0 w-72 bg-slate-900 text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300">
                <!-- Header Sidebar -->
                <?php
					if(isset($left)){
						$this->load->view($left);
					}
                ?>
            </aside>
            <!-- Overlay -->
            <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/40 hidden z-30 md:hidden"></div>
            <!-- Right -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Content -->
                <main class="flex-1 overflow-y-auto bg-slate-100 relative">
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
        <script>
			function toggleSidebar() {
				const sidebar = document.getElementById('sidebar');
				const overlay = document.getElementById('overlay');

				sidebar.classList.toggle('-translate-x-full');
				overlay.classList.toggle('hidden');
			}
        </script>
    </body>
</html>