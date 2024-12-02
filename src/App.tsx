
import { RouterProvider, createBrowserRouter } from "react-router-dom";
import {
  Cart,
  Checkout,
  HomeLayout,
  Landing,
  Login,
  OrderConfirmation,
  OrderHistory,
  Register,
  Search,
  Shop,
  SingleOrderHistory,
  SingleProduct,
  UserProfile,
} from "./pages";
import { checkoutAction, searchAction } from "./actions/index";
import { shopCategoryLoader } from "./pages/Shop";
import { loader as orderHistoryLoader } from "./pages/OrderHistory";
import { loader as singleOrderLoader } from "./pages/SingleOrderHistory";
//
//import {} from "./"
const router = createBrowserRouter([
  {
    path: "/",
    element: <HomeLayout />,
    children: [
      {
        index: true,
        element: <Landing />,
      },
      {
        path: "shop",
        element: <Shop />,
      },
      {
        path: "shop/:category",
        element: <Shop />,
        loader: shopCategoryLoader,
      },
      {
        path: "product/:id",
        element: <SingleProduct />,
      },
      {
        path: "cart",
        element: <Cart />,
      },
      {
        path: "checkout",
        element: <Checkout />,
        action: checkoutAction,
      },
      {
        path: "search",
        action: searchAction,
        element: <Search />,
      },
      {
        path: "login",
        element: <Login />,
      },
      {
        path: "register",
        element: <Register />,
      },
      {
        path: "order-confirmation",
        element: <OrderConfirmation />,
      },
      {
        path: "user-profile",
        element: <UserProfile />,
      },
      {
        path: "order-history",
        element: <OrderHistory />,
        loader: orderHistoryLoader,
      },
      {
        path: "order-history/:id",
        element: <SingleOrderHistory />,
        loader: singleOrderLoader
      },
    ],
  },
]);

function App() {
  return <RouterProvider router={router} />;
}

export default App;

/*
import { RouterProvider, createBrowserRouter } from "react-router-dom";
import React, { useState } from "react";
import { Outlet } from 'react-router-dom';


function HomeLayout() {
  return (
    <div>
      <h1>Article Management</h1>
      <Outlet />
    </div>
  );
}

function AddArticle() {
  const [articles, setArticles] = useState<
    { id: number; type: string; description: string; content: string; date: string }[]
  >([]);

  const handleSubmit = (e: React.FormEvent<HTMLFormElement>) => {
    e.preventDefault();
    const formData = new FormData(e.currentTarget);
    const newArticle = {
      id: Number(formData.get("id")),
      type: formData.get("type") as string,
      description: formData.get("description") as string,
      content: formData.get("content") as string,
      date: formData.get("date") as string,
    };

    setArticles((prev) => [...prev, newArticle]);
    e.currentTarget.reset();
  };

  return (
    <div style={{ padding: "20px" }}>
      <form onSubmit={handleSubmit} style={formStyles}>
        <h2>Add Article</h2>
        <label>Article ID:</label>
        <input type="number" name="id" required />
        <label>Article Type:</label>
        <input type="text" name="type" required />
        <label>Description:</label>
        <textarea name="description" required></textarea>
        <label>Content:</label>
        <textarea name="content" required></textarea>
        <label>Publish Date:</label>
        <input type="date" name="date" required />
        <button type="submit">Add Article</button>
      </form>
      <div style={{ marginTop: "20px" }}>
        <h3>Articles</h3>
        {articles.map((article, index) => (
          <div key={index} style={{ marginBottom: "10px" }}>
            {article.id} * {article.type} * {article.description} * {article.content} * {article.date}
          </div>
        ))}
      </div>
    </div>
  );
}

const formStyles: React.CSSProperties = {
  maxWidth: "500px",
  margin: "auto",
  padding: "20px",
  background: "#fff",
  borderRadius: "8px",
  boxShadow: "0 4px 8px rgba(0, 0, 0, 0.1)",
};

const router = createBrowserRouter([
  {
    path: "/",
    element: <HomeLayout />,
    children: [
      {
        index: true,
        element: <AddArticle />,
      },
    ],
  },
]);

function App() {
  return <RouterProvider router={router} />;
}

export default App;
*/