
    const allTabsGroup = document.querySelectorAll(".tabs-group");

    allTabsGroup.forEach((tabsGroup) => {
        for (let i = 0; i < tabsGroup.children.length; i++) {
            const tabs = tabsGroup.children[i].querySelectorAll('.tabs');
            const tabContent = tabsGroup.children[i].querySelectorAll('.tab-content-item');
            const indicator = tabsGroup.children[i].querySelector('.indicator');
            const tabsContainer = tabsGroup.children[0];
            const content = tabsGroup.children[1].querySelectorAll('.tab-content-item');

            if (indicator) {
                indicator.classList.add('bg-primary', 'h-0.5', 'absolute', 'bottom-0', 'left-0', 'transition-all', 'duration-200');
                indicator.style.width = `${100 / tabs.length}%`;
            }

            if (tabsContainer) {
                tabsContainer.classList.add('relative', 'flex', 'flex-row', 'items-center', 'justify-center');
            }

            if (content) {
                content.forEach((item) => {
                    item.classList.add('hidden', 'relative');
                });
                content[0].classList.remove('hidden');
            }

            const updateContent = (old, index) => {
                let oldContent = content[old / 100];
                let newContent = content[index];
                if ((old / 100) === index) return;

                if (oldContent && newContent) {
                    oldContent.classList.add('absolute', 'opacity-0', 'transition-all', 'duration-200');
                    newContent.classList.add('absolute', 'opacity-0', 'transition-all', 'duration-200');

                    setTimeout(() => {
                        oldContent.classList.remove('absolute', 'opacity-0', 'transition-all', 'duration-200');
                        oldContent.classList.add('hidden');

                        newContent.classList.add('!opacity-100');

                        newContent.classList.remove('!left-0', '!opacity-100', 'absolute', 'opacity-0', 'transition-all', 'duration-200');
                        newContent.classList.remove('hidden');
                    }, 200);
                }
            }

            tabs.forEach((tab, index) => {
                tab.classList.add('p-4', 'text-center', 'w-full', 'cursor-pointer', 'transition-all', 'duration-200', 'hover:bg-gray-200');
                tab.addEventListener('click', () => {
                    let old = (String(indicator.style.transform || 'translateX(0%)').split('translateX(')).filter(Boolean).join('').split('%)')[0];
                    indicator.style.transform = `translateX(${index * 100}%)`;
                    updateContent(old, index);
                })
            });

        }
    });