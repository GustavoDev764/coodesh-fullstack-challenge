export interface Links {
  url: string | null;
  label: string;
  active: boolean;
}

export interface Api<T> {
  success: boolean;
  data: Data<T>;
}

export interface ApiOne<T> {
  success: boolean;
  data: T;
}

export interface ApiOneArray<T> {
  success: boolean;
  data: T[];
}

export interface ApiFiles<T> {
  success: boolean;
  path: string;
  data: T[];
}

interface Data<T> {
  current_page: number;
  data: T[];
  first_page_url: string;
  from: string;
  last_page: string;
  last_page_url: string;
  links: Links[];
  next_page_url: string;
  path: string;
  per_page: number;
  prev_page_url: number;
  to: number;
  total: number;
}

export interface Create<T> {
  success: boolean;
  message?: string;
  data?: T;
}

export interface Update {
  success: boolean;
  message?: string;
}

export interface Delete {
  success: boolean;
}
