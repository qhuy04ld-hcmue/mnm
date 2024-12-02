import React from "react";
import ReactDOM from "react-dom/client";
import App from "./App.tsx";
import App1 from "./AddArticle.tsx"
import "./index.css";
import { store } from "./store.ts";
import { Provider } from "react-redux";
import { Toaster } from "react-hot-toast";

ReactDOM.createRoot(document.getElementById("root")!).render(
  <React.StrictMode>
    <Provider store={store}>
      <Toaster />
      <App />
    </Provider>
    <App1 />
  </React.StrictMode>
);
