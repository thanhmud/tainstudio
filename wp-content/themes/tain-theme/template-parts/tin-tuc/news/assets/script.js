let currentItems = 2;
      const handleLoadMore = () => {
        const items = Array.from(
          document.querySelectorAll("#loadContentNews .item_newsSlide_body")
        );
        let maxItems = items.length;
        // hiển thị thêm 2 mục
        for (let i = currentItems; i < currentItems + 2 && i < maxItems; i++) {
          items[i].style.display = "block";
        }

        currentItems += 2;

        // Ẩn nút nếu đã hiển thị tất cả các mục
        if (currentItems >= maxItems) {
          document.querySelector(
            "#loadContentNews .loadMore_news-btn"
          ).style.display = "none";
        }
      };
      const items = document.querySelectorAll(
        "#loadContentNews .item_newsSlide_body"
      );
      for (let i = 2; i < items.length; i++) {
        items[i].style.display = "none";
      }