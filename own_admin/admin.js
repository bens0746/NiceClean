document.getElementById('admin_main').style.display = 'none'
        document.getElementById('admin_postedit').style.display = 'none'
        document.getElementById('admin_userediter').style.display = 'none'
        document.getElementById('admin_report').style.display = 'block'
        document.getElementById('admin_cleanerediter').style.display = 'none'

        document.getElementById('btnmain').addEventListener('click',()=>{
            document.getElementById('admin_main').style.display = 'block'
            document.getElementById('admin_postedit').style.display = 'none'
            document.getElementById('admin_userediter').style.display = 'none'
            document.getElementById('admin_report').style.display = 'none'
            document.getElementById('admin_cleanerediter').style.display = 'none'
        })
        document.getElementById('btnedituser').addEventListener('click',()=>{
            document.getElementById('admin_main').style.display = 'none'
            document.getElementById('admin_postedit').style.display = 'none'
            document.getElementById('admin_userediter').style.display = 'block'
            document.getElementById('admin_report').style.display = 'none'
            document.getElementById('admin_cleanerediter').style.display = 'none'
        })
        document.getElementById('btneditpost').addEventListener('click',()=>{
            document.getElementById('admin_main').style.display = 'none'
            document.getElementById('admin_postedit').style.display = 'block'
            document.getElementById('admin_userediter').style.display = 'none'
            document.getElementById('admin_report').style.display = 'none'
            document.getElementById('admin_cleanerediter').style.display = 'none'
        })
        document.getElementById('btnreport').addEventListener('click',()=>{
            document.getElementById('admin_main').style.display = 'none'
            document.getElementById('admin_postedit').style.display = 'none'
            document.getElementById('admin_userediter').style.display = 'none'
            document.getElementById('admin_report').style.display = 'block'
            document.getElementById('admin_cleanerediter').style.display = 'none'
        })
        document.getElementById('btneditcleaner').addEventListener('click',()=>{
            document.getElementById('admin_main').style.display = 'none'
            document.getElementById('admin_postedit').style.display = 'none'
            document.getElementById('admin_userediter').style.display = 'none'
            document.getElementById('admin_report').style.display = 'none'
            document.getElementById('admin_cleanerediter').style.display = 'block'
        })






    const body = document.querySelector("body"),
        nav = document.querySelector("nav"),
        modeToggle = document.querySelector(".dark-light"),
        sidebarOpen = document.querySelector(".sidebarOpen"),
        siderbarClose = document.querySelector(".siderbarClose");

        let getMode = localStorage.getItem("mode");
            if(getMode && getMode === "dark-mode"){
                body.classList.add("dark");
            }


        modeToggle.addEventListener("click" , () =>{
            modeToggle.classList.toggle("active");
            body.classList.toggle("dark");


            if(!body.classList.contains("dark")){
                localStorage.setItem("mode" , "light-mode");
            }else{
                localStorage.setItem("mode" , "dark-mode");
            }
        });
    
        
        sidebarOpen.addEventListener("click" , () =>{
            nav.classList.add("active");
        });



        body.addEventListener("click" , e =>{
            let clickedElm = e.target;

            if(!clickedElm.classList.contains("sidebarOpen") && !clickedElm.classList.contains("menu")){
                nav.classList.remove("active");
            }
        });